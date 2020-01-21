<?php

namespace DavideCasiraghi\LaravelColumns\Http\Controllers;

use DavideCasiraghi\LaravelColumns\Models\ColumnGroupTranslation;
use Illuminate\Http\Request;
use Validator;

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
    public function edit($columnGroupId, $languageCode)
    {
        $columnGroupTranslation = ColumnGroupTranslation::where('column_group_id', $columnGroupId)
                        ->where('locale', $languageCode)
                        ->first();

        $selectedLocaleName = $this->getSelectedLocaleName($languageCode);

        return view('laravel-columns::columnGroupTranslations.edit', compact('columnGroupTranslation'))
                    ->with('columnGroupId', $columnGroupId)
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

        $columnGroupTranslation = new ColumnGroupTranslation();

        $this->saveOnDb($request, $columnGroupTranslation, 'save');

        return redirect()->route('columnGroups.index')
                            ->with('success', 'Column group translation added succesfully');
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

        $columnGroupTranslation = ColumnGroupTranslation::find($request->get('column_group_translation_id'));

        //dd($columnGroupTranslation);
        $this->saveOnDb($request, $columnGroupTranslation, 'update');

        return redirect()->route('columnGroups.index')
                            ->with('success', 'Column group translation added succesfully');
    }

    /***************************************************************************/

    /**
     * Save the record on DB.
     * @param  \Illuminate\Http\Request  $request
     * @param  \DavideCasiraghi\LaravelColumns\Models\ColumnGroupTranslation  $columnGroupTranslation
     * @return void
     */
    public function saveOnDb($request, $columnGroupTranslation, $saveOrUpdate)
    {
        //dd($columnTranslation);
        $columnGroupTranslation->title = $request->get('title');
        $columnGroupTranslation->description = $request->get('description');
        $columnGroupTranslation->button_text = $request->get('button_text');

        switch ($saveOrUpdate) {
            case 'save':
                $columnGroupTranslation->column_group_id = $request->get('column_group_id');
                $columnGroupTranslation->locale = $request->get('language_code');
                $columnGroupTranslation->save();
                break;
            case 'update':
                $columnGroupTranslation->update();
                break;
        }
    }

    /***************************************************************************/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $columnGroupTranslationId
     */
    public function destroy($columnGroupTranslationId)
    {
        $columnGroupTranslation = ColumnGroupTranslation::find($columnGroupTranslationId);
        $columnGroupTranslation->delete();

        return redirect()->route('columnGroups.index')
                            ->with('success', 'Column group translation deleted succesfully');
    }
}
