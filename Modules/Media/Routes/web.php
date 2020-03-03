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

Route::prefix('media')->group(function() {

    Route::prefix('artist')->group(function (){
        Route::post('/', 'ArtistController@store');
        Route::put('/{artist}', 'ArtistController@update');
    });

});
