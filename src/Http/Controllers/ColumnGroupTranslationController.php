<?php

namespace DavideCasiraghi\LaravelColumns\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use DavideCasiraghi\LaravelColumns\Models\ColumnGroupTranslation;

class ColumnGroupTranslationController extends Controller
{
    /***************************************************************************/

    /**
     * Show the form for creating a new resource.
     * @param int $columnId
     * @param string $languageCode
     * @return \Illuminate\Http\Response
     */
    public function create($columnGroupId, $languageCode)
    {
        $selectedLocaleName = $this->getSelectedLocaleName($languageCode);

        return view('laravel-columns::columnGroupTranslations.create')
                ->with('columnGroupId', $columnGroupId)
                ->with('languageCode', $languageCode)
                ->with('selectedLocaleName', $selectedLocaleName);
    }

    /***************************************************************************/

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $columnTranslationId
     * @param string $languageCode
     * @return \Illuminate\Http\Response
     */
    public function edit($columnId, $languageCode)
    {
        $columnTranslation = ColumnTranslation::where('column_id', $columnId)
                        ->where('locale', $languageCode)
                        ->first();

        $selectedLocaleName = $this->getSelectedLocaleName($languageCode);

        return view('laravel-columns::columnsTranslations.edit', compact('columnTranslation'))
                    ->with('columnId', $columnId)
                    ->with('languageCode', $languageCode)
                    ->with('selectedLocaleName', $selectedLocaleName);
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

        $columnTranslation = new ColumnTranslation();

        $this->saveOnDb($request, $columnTranslation, 'save');

        return redirect()->route('columns.index')
                            ->with('success', 'Column translation added succesfully');
    }

    /***************************************************************************/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $columnTranslationId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Validate form datas
        $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $columnTranslation = ColumnTranslation::find($request->get('column_translation_id'));
        
        //dd($columnTranslation);
        //$eventCategoryTranslation = EventCategoryTranslation::where('id', $request->get('event_category_translation_id'));
        
        //dd($columnTranslation);
        $this->saveOnDb($request, $columnTranslation, 'update');

        return redirect()->route('columns.index')
                            ->with('success', 'Column translation added succesfully');
    }

    /***************************************************************************/

    /**
     * Save the record on DB.
     * @param  \Illuminate\Http\Request  $request
     * @param  \DavideCasiraghi\LaravelColumns\Models\ColumnTranslation  $columnTranslation
     * @return void
     */
    public function saveOnDb($request, $columnTranslation, $saveOrUpdate)
    {
        //dd($columnTranslation);
        $columnTranslation->title = $request->get('title');
        $columnTranslation->body = $request->get('body');
        $columnTranslation->button_text = $request->get('button_text');

        switch ($saveOrUpdate) {
            case 'save':
                $columnTranslation->column_id = $request->get('column_id');
                $columnTranslation->locale = $request->get('language_code');
                $columnTranslation->save();
                break;
            case 'update':
                $columnTranslation->update();
                break;
        }
    }

    /***************************************************************************/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $columnTranslationId
     */
    public function destroy($columnTranslationId)
    {
        $columnTranslation = ColumnTranslation::find($columnTranslationId);
        $columnTranslation->delete();

        return redirect()->route('columns.index')
                            ->with('success', 'Column translation deleted succesfully');
    }
}
