<?php

    Route::group(['namespace' => 'DavideCasiraghi\LaravelCards\Http\Controllers', 'middleware' => 'web'], function () {

        /* Cards */
        Route::resource('laravel-columns', 'CardController');

        /* Card translations */
        Route::get('laravel-columns-translation/{imageId}/{languageCode}/create', 'CardTranslationController@create')->name('laravel-columns-translation.create');
        Route::get('laravel-columns-translation/{imageId}/{languageCode}/edit', 'CardTranslationController@edit')->name('laravel-columns-translation.edit');
        Route::resource('laravel-columns-translation', 'CardTranslationController')->except(['create', 'edit']);
    });
