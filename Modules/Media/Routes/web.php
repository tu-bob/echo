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

use Illuminate\Support\Facades\Route;

Route::prefix('media')->group(function () {

    Route::prefix('artist')->group(function () {

        Route::prefix('alias')->group(function () {
            Route::get('/filter', 'Artist\ArtistAliasController@filter');
        });

        Route::post('/', 'Artist\ArtistController@store');
        Route::get('/list', 'Artist\ArtistController@getArtists');
        Route::put('/{artist}', 'Artist\ArtistController@update');
        Route::get('/{artist}', 'Artist\ArtistController@getArtist');
    });

    Route::prefix('image')->group(function () {
        Route::post('/many', 'Image\ImageController@storeMany');
        Route::get('/{image}/{type}', 'Image\ImageController@getImage');
    });

    Route::prefix('music')->group(function () {

        Route::prefix('genre')->group(function () {
            Route::get('/', 'Music\GenreController@all');
        });

        Route::prefix('song')->group(function () {
            Route::post('/', 'Music\SongController@store');
            Route::get('/list', 'Music\SongController@getSongs');
            Route::get('/find/{info}', 'Music\SongController@findSongsByInfo');
            Route::get('/{song}/audio', 'Music\SongController@getAudioFile');
            Route::get('/{song}', 'Music\SongController@getSong');
        });

        Route::prefix('album')->group(function () {
            Route::post('/', 'Music\MusicAlbumController@store');
            Route::get('/list', 'Music\MusicAlbumController@getAlbums');
            Route::get('/filter', 'Music\MusicAlbumController@filter');
            Route::get('/types', 'Music\MusicAlbumController@getAlbumTypes');
            Route::get('/{album}/cover', 'Music\MusicAlbumController@getCover');
            Route::get('/{album}', 'Music\MusicAlbumController@getAlbum');
        });
    });

});
