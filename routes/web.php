<?php

    Route::group(['namespace' => 'DavideCasiraghi\LaravelColumns\Http\Controllers', 'middleware' => 'web'], function () {

        /* Column Groups */
        Route::resource('columnGroups', 'ColumnGroupController');

        /* Column Group translations */
        Route::get('columnGroupTranslations/{columnGroupId}/{languageCode}/create', 'ColumnGroupTranslationController@create')->name('columnGroupTranslations.create');
        Route::get('columnGroupTranslations/{columnGroupId}/{languageCode}/edit', 'ColumnGroupTranslationController@edit')->name('columnGroupTranslations.edit');
        Route::resource('columnGroupTranslations', 'ColumnGroupTranslationController')->except(['create', 'edit']);

        /* Columns */
        Route::resource('columns', 'ColumnController');

        /* Column translations */
        Route::get('columnTranslations/{columnId}/{languageCode}/create', 'ColumnTranslationController@create')->name('columnTranslations.create');
        Route::get('columnTranslations/{columnId}/{languageCode}/edit', 'ColumnTranslationController@edit')->name('columnTranslations.edit');
        Route::post('/columnTranslations/store', 'ColumnTranslationController@store')->name('columnTranslations.store');
        Route::put('/columnTranslations/update', 'ColumnTranslationController@update')->name('columnTranslations.update');
        Route::delete('/columnTranslations/destroy/{columnTranslationId}', 'ColumnTranslationController@destroy')->name('columnTranslations.destroy');


        //Route::resource('columnTranslations', 'ColumnTranslationController')->except(['create', 'edit']);
    
    });
