<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/imagegallery', function (Request $request) {
//    return $request->user();
//});

use Illuminate\Support\Facades\Route;

Route::prefix('image-gallery')->group(function () {
    Route::get('files/{image}', 'ImageFilesController@show');

    Route::post('files/', 'ImageFilesController@store');
});
