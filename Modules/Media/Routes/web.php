<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('media')->group(function () {

    Route::prefix('artist')->group(function () {

        Route::prefix('alias')->group(function () {
            Route::get('/filter', 'Artist\ArtistAliasController@filter');
        });

        Route::post('/', 'Artist\ArtistController@store');
        Route::put('/{artist}', 'Artist\ArtistController@update');
//        Route::get('/find', 'ArtistController@findArtist');
        Route::get('/{artist}', 'Artist\ArtistController@getArtist');
    });

    Route::prefix('music')->group(function () {

        Route::prefix('genre')->group(function () {
            Route::get('/', 'Music\GenreController@all');
        });

        Route::prefix('song')->group(function () {
            Route::post('/', 'Music\SongController@store');
        });
    });

});
