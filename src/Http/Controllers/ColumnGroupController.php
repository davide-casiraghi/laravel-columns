<?php

namespace DavideCasiraghi\LaravelColumns\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use DavideCasiraghi\LaravelColumns\Models\Column;
use DavideCasiraghi\LaravelColumns\Models\ColumnGroup;
use Intervention\Image\ImageManagerStatic as Image;
use DavideCasiraghi\LaravelColumns\Facades\LaravelColumns;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use DavideCasiraghi\LaravelFormPartials\Facades\LaravelFormPartials;

class ColumnGroupController extends Controller
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
            $columnGroups = ColumnGroup::
                        select('column_group_translations.column_group_id AS id', 'title', 'description', 'button_text', 'image_file_name', 'button_url', 'locale')
                        ->join('column_group_translations', 'column_groups.id', '=', 'column_group_translations.column_group_id')
                        ->orderBy('title')
                        ->where('title', 'like', '%'.$searchKeywords.'%')
                        ->where('locale', 'en')
                        ->paginate(20);
        } else {
            $columnGroups = ColumnGroup::
                        select('column_group_translations.column_group_id AS id', 'title', 'description', 'button_text', 'image_file_name', 'button_url', 'locale')
                        ->join('column_group_translations', 'column_groups.id', '=', 'column_group_translations.column_group_id')
                        ->where('locale', 'en')
                        ->orderBy('title')
                        ->paginate(20);
        }

        return view('laravel-columns::columnGroups.index', compact('columnGroups'))
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
        return view('laravel-columns::columnGroups.create')
                    ->with('buttonColorArray', $this->getButtonColorArray());
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
        
        $columnGroup = new ColumnGroup();

        // Set the default language to edit the quote in English
        App::setLocale('en');

        $this->saveOnDb($request, $columnGroup);

        return redirect()->route('columnGroups.index')
                            ->with('success', 'Column group added succesfully');
    }

    /***************************************************************************/

    /**
     * Display the specified resource.
     *
     * @param  int $columnId
     * @return \Illuminate\Http\Response
     */
    public function show($columnGroupId = null)
    {
        //$column = Column::find($columnGroupId);
        $columnGroup = Laravelcolumns::getColumn($columnGroupId);
        $columnParameters = ($columnGroup) ? (Laravelcolumns::getParametersArray($columnGroup)) : null;

        return view('laravel-columns::columnGroups.show', compact('column'))
                ->with('columnParameters', $columnParameters);
    }

    /***************************************************************************/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $columnId
     * @return \Illuminate\Http\Response
     */
    public function edit($columnGroupId = null)
    {
        $columnGroup = ColumnGroup::find($columnGroupId);

        return view('laravel-columns::columnGroups.edit', compact('columnGroup'))
                    ->with('columnGroupsArray', $this->getColumnGroupsArray());
    }

    /***************************************************************************/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $columnGroupId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $columnGroupId)
    {    
        // Validate form datas
        $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $columnGroup = ColumnGroup::find($columnGroupId);

        // Set the default language to update the quote in English
        App::setLocale('en');

        $this->saveOnDb($request, $columnGroup);

        return redirect()->route('columnGroups.index')
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
        $columnGroup->delete();

        return redirect()->route('columnGroups.index')
                            ->with('success', 'Column image deleted succesfully');
    }

    /***************************************************************************/

    /**
     * Save the record on DB.
     * @param  \Illuminate\Http\Request  $request
     * @param  \DavideCasiraghi\Laravelcolumns\Models\ColumnGroup  $column
     * @return void
     */
    public function saveOnDb($request, $columnGroup)
    {
        $columnGroup->translateOrNew('en')->title = $request->get('title');
        $columnGroup->translateOrNew('en')->description = $request->get('description');
        $columnGroup->translateOrNew('en')->button_text = $request->get('button_text');
        $columnGroup->translateOrNew('en')->image_alt = $request->get('image_alt');

        $columnGroup->number_of_columns_shown = $request->get('number_of_columns_shown');
        $columnGroup->bkg_color = $request->get('bkg_color');
        $columnGroup->group_title_color = $request->get('group_title_color');
        $columnGroup->group_title_font_size = $request->get('group_title_font_size');
        $columnGroup->column_title_color = $request->get('column_title_color');
        $columnGroup->column_title_font_size = $request->get('column_title_font_size');
        $columnGroup->description_font_size = $request->get('description_font_size');
        $columnGroup->link_style = $request->get('link_style');
        $columnGroup->button_url = $request->get('button_url');
        $columnGroup->button_color = $request->get('button_color');
        $columnGroup->button_corners = $request->get('button_corners');
        $columnGroup->background_type = $request->get('background_type');
        $columnGroup->background_image = $request->get('background_image');
        $columnGroup->background_image_position = $request->get('background_image_position');
        $columnGroup->justify_content = $request->get('justify_content');
        $columnGroup->flex_wrap = $request->get('flex_wrap');
        $columnGroup->flex_flow = $request->get('flex_flow');
        $columnGroup->columns_flex = $request->get('columns_flex');
        $columnGroup->columns_padding = $request->get('columns_padding');
        $columnGroup->columns_box_sizing = $request->get('columns_box_sizing');
        $columnGroup->columns_round_images = $request->get('columns_round_images');
        $columnGroup->columns_images_width = $request->get('columns_images_width');
        $columnGroup->columns_images_hide_mobile = $request->get('columns_images_hide_mobile');
        $columnGroup->icons_size = $request->get('icons_size');

        // Column group image upload
        $imageSubdir = 'column_groups';
        $imageWidth = '1067';
        $thumbWidth = '690';
        $columnGroup->background_image = LaravelFormPartials::uploadImageOnServer($request->file('background_image'), $request->background_image, $imageSubdir, $imageWidth, $thumbWidth);

        $columnGroup->save();
    }
    
    /***************************************************************************/

    /**
     * Return and array with the button possible color options.
     *
     * @return array
     */
    public static function getButtonColorArray()
    {
        $ret = [
             'press-red' => 'Red',
             'press-pink' => 'Pink',
             'press-purple' => 'Purple',
             'press-deeppurple' => 'Deep purple',
             'press-indigo' => 'Indigo',
             'press-blue' => 'Blue',
             'press-lightblue' => 'Light blue',
             'press-cyan' => 'Cyan',
             'press-teal' => 'Teal',
             'press-green' => 'Green',
             'press-lightgreen' => 'Light green',
             'press-lime' => 'Lime',
             'press-yellow' => 'Yellow',
             'press-amber' => 'Amber',
             'press-orange' => 'Orange',
             'press-deeporange' => 'Deeporange',
             'press-brown' => 'Brown',
             'press-grey' => 'Grey',
             'press-bluegrey' => 'Blue grey',
             'press-black' => 'Black',
         ];

        return $ret;
    }
}
