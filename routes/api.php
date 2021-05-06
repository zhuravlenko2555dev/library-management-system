<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->group(function () {
    Route::post('login', 'UserController@login');

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('refreshToken', 'UserController@refreshToken');
        Route::post('logout', 'UserController@logout');
        Route::post('user', 'UserController@user');
    });
});
Route::prefix('readers')->group(function () {
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('count', 'UserController@readersCount');
        Route::get('active', 'UserController@readersActive');
    });
});
Route::prefix('books')->group(function () {
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('count', 'BookController@count');
        Route::get('borrowedCount', 'BookController@borrowedCount');
        Route::get('nonReturnCount', 'BookController@nonReturnCount');
        Route::get('borrowedGraph', 'BookController@borrowedGraph');
        Route::get('popular', 'BookController@popular');
    });
});
