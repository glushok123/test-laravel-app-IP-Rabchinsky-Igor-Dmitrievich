<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', 'App\Http\Controllers\TestController@test');

Route::get('/admin-url/', 'App\Http\Controllers\UrlPageController@admin');
//Route::get('/admin/dashboard', 'App\Http\Controllers\UrlPageController@admin');
Route::get('/unique-id/{url}', 'App\Http\Controllers\UrlPageController@show');
Route::post('/change-attribute', 'App\Http\Controllers\UrlPageController@change');
Route::post('/change-config', 'App\Http\Controllers\ConfigurationController@change');
Route::post('/generate-url', 'App\Http\Controllers\UrlPageController@generateUrl');
Route::post('/generate-url-for-user', 'App\Http\Controllers\UrlPageController@generateUrlForUser');
Route::post('/active-url', 'App\Http\Controllers\UrlPageController@activeUrl');
Route::post('/save-comment-url', 'App\Http\Controllers\UrlPageController@saveCommentUrl');
Route::post('/start-init', 'App\Http\Controllers\UrlPageController@startInit');
