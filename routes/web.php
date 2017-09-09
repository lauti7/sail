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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/profile/{slug}', 'ProfileController@getProfile')->name('profile');
Route::post('/profile/{slug}', 'ProfileController@uploadPhoto');
Route::get('/profile/edit/{slug}', 'ProfileController@editProfile');
Route::post('/profile/edit/{slug}', 'ProfileController@uploadProfile');
Route::get('/finish', 'ProfileController@getFinishProfile');
Route::post('/finish', 'ProfileController@postFinishProfile');
Route::post('/comment/{profile_id}', 'CommentsController@newComment');

Route::get('/home', 'HomeController@index');
