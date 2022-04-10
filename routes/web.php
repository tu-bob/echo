<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/users', 'UserController@index');

Route::get('/', function () {
    return redirect('/app/overview');
});

Route::get('/app', function () {
    return redirect('/app/overview');
});



Route::prefix('auth')->group(function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::middleware('auth')->post('logout', 'Auth\LoginController@logout');
    Route::post('register', 'Auth\RegisterController@register');
    Route::get('user', function (){
        return \auth()->user();
    });
});

Route::prefix('app')->group(function () {
    Route::get('{any}', function () {
        return view('layouts/app');
    })->where('any', '.*');
});

Route::prefix('admin')->group(function () {
    Route::get('{any}', function () {
        return view('layouts/app');
    })->where('any', '.*');
});
