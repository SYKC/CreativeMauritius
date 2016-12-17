<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('register', function () {
  return('register');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('user/{username}', [
  'uses' => 'ProfileController@getProfile',
  'as' => 'user.profile',
]);

Route::get('/profile/{username}/edit', [
	'uses' => 'ProfileController@getProfileUpdate',
	'as' => 'user.edit',
]);

Route::post('/profile/{username}/edit', [
	'uses' => 'ProfileController@postProfileUpdate',
	'as' => 'user.edit',
]);

Route::get('/upload',  'UploadController@UserUpload');
