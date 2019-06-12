<?php

    Route::group(['namespace' => 'DavideCasiraghi\LaravelColumns\Http\Controllers', 'middleware' => 'web'], function () {

        /* Column Groups */
        Route::resource('laravel-column-groups', 'CardController');

        /* Column Group translations */
        Route::get('laravel-column-groups-translation/{imageId}/{languageCode}/create', 'CardTranslationController@create')->name('laravel-column-groups-translation.create');
        Route::get('laravel-column-groups-translation/{imageId}/{languageCode}/edit', 'CardTranslationController@edit')->name('laravel-column-groups-translation.edit');
        Route::resource('laravel-column-groups-translation', 'CardTranslationController')->except(['create', 'edit']);

        /* Columns */
        Route::resource('laravel-columns', 'CardController');

        /* Column translations */
        Route::get('laravel-columns-translation/{imageId}/{languageCode}/create', 'CardTranslationController@create')->name('laravel-columns-translation.create');
        Route::get('laravel-columns-translation/{imageId}/{languageCode}/edit', 'CardTranslationController@edit')->name('laravel-columns-translation.edit');
        Route::resource('laravel-columns-translation', 'CardTranslationController')->except(['create', 'edit']);
    
    });
