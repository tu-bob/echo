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
use Modules\Media\Http\Controllers\Chart\MusicalChartController;

Route::prefix('media')->group(function () {

    Route::prefix('artist')->group(function () {

        Route::prefix('alias')->group(function () {
            Route::get('/filter', 'Artist\ArtistAliasController@filter');
        });

        Route::post('/', 'Artist\ArtistController@store');
        Route::get('/list', 'Artist\ArtistController@getArtists');
        Route::post('/{artist}', 'Artist\ArtistController@update');
        Route::get('/{artist}', 'Artist\ArtistController@getArtist');
    });

    Route::prefix('alias-artist')->group(function () {
        Route::get('/{aliasArtist}', 'Artist\AliasArtistController@show');
    });

    Route::prefix('image')->group(function () {
        Route::post('/many', 'Image\ImageController@storeMany');
        Route::get('/{image}/{type}', 'Image\ImageController@getImage');
    });

    Route::prefix('music')->group(function () {

        Route::prefix('genre')->group(function () {
            Route::get('/', 'Music\GenreController@all');
            Route::get('/list', 'Music\GenreController@getGenres');
        });

        Route::prefix('song')->group(function () {
            Route::post('/', 'Music\Song\SongController@store');
            Route::get('/list', 'Music\Song\SongController@getSongs');
            Route::get('/find/{info}', 'Music\Song\SongController@findSongsByInfo');
//            Route::get('/{song}/audio', 'Music\Song\SongController@getAudioFile');
            Route::get('/{song}/icon', 'Music\Song\SongIconController@show');
            Route::get('/{song}/download', 'Music\Song\SongController@downloadSong');
            Route::put('/{song}/play', 'Music\Song\SongPlaybackController@store');
            Route::get('/{song}', 'Music\Song\SongController@getSong');
        });

        Route::resource('audio', 'Music\Song\SongAudioFileController')->parameters(['audio' => 'song']);

        Route::prefix('album')->group(function () {
            Route::post('/', 'Music\MusicAlbumController@store');
            Route::get('/list', 'Music\MusicAlbumController@getAlbums');
            Route::get('/filter', 'Music\MusicAlbumController@filter');
            Route::get('/types', 'Music\MusicAlbumController@getAlbumTypes');
            Route::get('/{album}/cover', 'Music\Album\MusicAlbumCoverController@show');
            Route::get('/{album}/songs', 'Music\MusicAlbumSongController@getSongs');
            Route::put('/{album}/play', 'Music\MusicAlbumController@countPlay');
            Route::put('/{album}/view', 'Music\MusicAlbumController@countView');
            Route::get('/{album}', 'Music\MusicAlbumController@getAlbum');
        });
    });

    Route::prefix('video')->group(function () {
        Route::get('/list', 'Video\VideoController@getVideos');
        Route::put('/{video}/view', 'Video\VideoController@incrementViewCount');
        Route::put('/{video}/play', 'Video\VideoController@incrementPlayCount');
        Route::post('/', 'Video\VideoController@store');
        Route::put('/{video}', 'Video\VideoController@update');
        Route::get('/{video}', 'Video\VideoController@show');
        Route::get('/', 'Video\VideoController@index');
        Route::delete('/{video}', 'Video\VideoController@destroy');
    });

    //Chart Routes
    Route::prefix('chart')->group(function (){
        Route::prefix('music')->group(function (){
            Route::get('monthly', [MusicalChartController::class, 'getMonthlyTop']);
            Route::get('weekly', [MusicalChartController::class, 'getWeeklyTop']);
            Route::get('daily', [MusicalChartController::class, 'getDailyTop']);
        });
    });

    Route::get('/search/{needle}', 'Search\SearchController@search');
});
