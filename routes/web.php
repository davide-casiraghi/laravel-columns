<?php

    Route::group(['namespace' => 'DavideCasiraghi\LaravelColumns\Http\Controllers', 'middleware' => 'web'], function () {

        /* Column Groups */
        Route::resource('column-groups', 'ColumnGroupController');

        /* Column Group translations */
        Route::get('column-groups-translation/{columnGroupId}/{languageCode}/create', 'ColumnGroupTranslationController@create')->name('column-groups-translation.create');
        Route::get('column-groups-translation/{columnGroupId}/{languageCode}/edit', 'ColumnGroupTranslationController@edit')->name('column-groups-translation.edit');
        Route::resource('column-groups-translation', 'ColumnGroupTranslationController')->except(['create', 'edit']);

        /* Columns */
        Route::resource('columns', 'ColumnController');

        /* Column translations */
        Route::get('columns-translation/{columnId}/{languageCode}/create', 'ColumnTranslationController@create')->name('columns-translation.create');
        Route::get('columns-translation/{columnId}/{languageCode}/edit', 'ColumnTranslationController@edit')->name('columns-translation.edit');
        Route::resource('columns-translation', 'ColumnTranslationController')->except(['create', 'edit']);
    
    });
