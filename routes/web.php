<?php

    Route::group(['namespace' => 'DavideCasiraghi\LaravelColumns\Http\Controllers', 'middleware' => 'web'], function () {

        /* Column Groups */
        Route::resource('laravel-column-groups', 'ColumnGroupController');

        /* Column Group translations */
        Route::get('laravel-column-groups-translation/{imageId}/{languageCode}/create', 'ColumnGroupTranslationController@create')->name('laravel-column-groups-translation.create');
        Route::get('laravel-column-groups-translation/{imageId}/{languageCode}/edit', 'ColumnGroupTranslationController@edit')->name('laravel-column-groups-translation.edit');
        Route::resource('laravel-column-groups-translation', 'ColumnGroupTranslationController')->except(['create', 'edit']);

        /* Columns */
        Route::resource('laravel-columns', 'ColumnController');

        /* Column translations */
        Route::get('laravel-columns-translation/{imageId}/{languageCode}/create', 'ColumnTranslationController@create')->name('laravel-columns-translation.create');
        Route::get('laravel-columns-translation/{imageId}/{languageCode}/edit', 'ColumnTranslationController@edit')->name('laravel-columns-translation.edit');
        Route::resource('laravel-columns-translation', 'ColumnTranslationController')->except(['create', 'edit']);
    
    });
