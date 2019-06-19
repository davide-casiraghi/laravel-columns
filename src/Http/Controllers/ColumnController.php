<?php

namespace DavideCasiraghi\LaravelColumns\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use DavideCasiraghi\LaravelColumns\Models\Column;
use Intervention\Image\ImageManagerStatic as Image;
use DavideCasiraghi\LaravelColumns\Models\ColumnGroup;
use DavideCasiraghi\LaravelColumns\Facades\LaravelColumns;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use DavideCasiraghi\LaravelFormPartials\Facades\LaravelFormPartials;

class ColumnController extends Controller
{
    /* Restrict the access to this resource just to logged in users */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchKeywords = $request->input('keywords');
        //$searchCategory = $request->input('category_id');
        $countriesAvailableForTranslations = LaravelLocalization::getSupportedLocales();

        if ($searchKeywords) {
            $columns = Column::
                        select('column_translations.column_id AS id', 'title', 'body', 'button_text', 'image_file_name', 'button_url', 'locale')
                        ->join('column_translations', 'columns.id', '=', 'column_translations.column_id')
                        ->orderBy('title')
                        ->where('title', 'like', '%'.$searchKeywords.'%')
                        ->where('locale', 'en')
                        ->paginate(20);
        } else {
            $columns = Column::
                        select('column_translations.column_id AS id', 'title', 'body', 'button_text', 'image_file_name', 'button_url', 'locale')
                        ->join('column_translations', 'columns.id', '=', 'column_translations.column_id')
                        ->where('locale', 'en')
                        ->orderBy('title')
                        ->paginate(20);
        }

        return view('laravel-columns::columns.index', compact('columns'))
                     ->with('i', (request()->input('page', 1) - 1) * 20)
                     ->with('searchKeywords', $searchKeywords)
                     ->with('countriesAvailableForTranslations', $countriesAvailableForTranslations);
    }

    /***************************************************************************/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laravel-columns::columns.create')
                    ->with('columnGroupsArray', $this->getColumnGroupsArray());
    }

    /***************************************************************************/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate form datas
        $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $column = new Column();

        // Set the default language to edit the quote in English
        App::setLocale('en');

        $this->saveOnDb($request, $column);

        return redirect()->route('columns.index')
                            ->with('success', 'Column image added succesfully');
    }

    /***************************************************************************/

    /**
     * Display the specified resource.
     *
     * @param  int $columnId
     * @return \Illuminate\Http\Response
     */
    public function show($columnId = null)
    {
        //$column = Column::find($columnId);
        $column = Laravelcolumns::getColumn($columnId);
        $columnParameters = ($column) ? (Laravelcolumns::getParametersArray($column)) : null;

        return view('laravel-columns::columns.show', compact('column'))
                ->with('columnParameters', $columnParameters);
    }

    /***************************************************************************/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $columnId
     * @return \Illuminate\Http\Response
     */
    public function edit($columnId = null)
    {
        $column = Column::find($columnId);

        return view('laravel-columns::columns.edit', compact('column'))
                    ->with('columnGroupsArray', $this->getColumnGroupsArray());
    }

    /***************************************************************************/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $columnId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $columnId)
    {
        // Validate form datas
        $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $column = Column::find($columnId);

        // Set the default language to update the quote in English
        App::setLocale('en');

        $this->saveOnDb($request, $column);

        return redirect()->route('columns.index')
                            ->with('success', 'Column image updated succesfully');
    }

    /***************************************************************************/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $columnId
     * @return \Illuminate\Http\Response
     */
    public function destroy($columnId)
    {
        $column = Column::find($columnId);
        $column->delete();

        return redirect()->route('columns.index')
                            ->with('success', 'Column image deleted succesfully');
    }

    /***************************************************************************/

    /**
     * Save the record on DB.
     * @param  \Illuminate\Http\Request  $request
     * @param  \DavideCasiraghi\Laravelcolumns\Models\Column  $column
     * @return void
     */
    public function saveOnDb($request, $column)
    {
        $column->translateOrNew('en')->title = $request->get('title');
        $column->translateOrNew('en')->body = $request->get('body');
        $column->translateOrNew('en')->button_text = $request->get('button_text');
        $column->translateOrNew('en')->image_alt = $request->get('image_alt');

        $column->columns_group = $request->get('columns_group');
        $column->column_flex = $request->get('column_flex');
        $column->separator_color = $request->get('separator_color');
        $column->image_file_name = $request->get('image_file_name');
        $column->fontawesome_icon_class = $request->get('fontawesome_icon_class');
        $column->icon_color = $request->get('icon_color');
        $column->button_url = $request->get('button_url');

        // Column image upload
        $imageSubdir = 'columns';
        $imageWidth = '1067';
        $thumbWidth = '690';
        $column->image_file_name = LaravelFormPartials::uploadImageOnServer($request->file('image_file_name'), $request->image_file_name, $imageSubdir, $imageWidth, $thumbWidth);

        $column->save();
    }

    /***************************************************************************/

    /**
     * Return and array with the column groups.
     *
     * @return array
     */
    public static function getColumnGroupsArray()
    {
        $ret = ColumnGroup::listsTranslations('title')->orderBy('title')->pluck('title', 'id');

        return $ret;
    }
}
