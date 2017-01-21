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
  /*Change to return view('/'); when out of beta*/
    return view('beta');
});

Route::get('register', function () {
  return('register');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/blog', 'BlogController@index');

Route::get('/dashboard', 'AdminController@index');

Route::get('/dashboard/posts/create', [
  'uses' => 'PostController@getPage',
  'as' => 'dashboard.posts',
]);

Route::post('/dashboard/posts/create/new', [
  'uses' => 'PostController@createPost',
  'as' => 'post.create',
]);

Route::get('/dashboard/media', [
  'uses' => 'AdminController@getMedia',
  'as' => 'dashboard.media',
]);

Route::get('/dashboard/posts/all', [
  'uses' => 'AdminController@getWrittenPosts',
  'as' => 'dashboard.written',
]);

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
