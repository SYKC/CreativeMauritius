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

//---------------Routing for Projects---------------
//------------We are making history here------------
// ------------->Create a new Project<-------------//
Route::get('/dashboard/projects/create', [
  'uses' => 'ProjectController@getPage',
  'as' => 'dashboard.projects.index',
]);

// ------------->Publish a new Project<-------------//
Route::post('/dashboard/projects/create/publish', [
  'uses' => 'ProjectController@publishProject',
  'as' => 'project.publish',
]);

//--------------------------&&--------------------------//
//-----------------Routing for Blog Posts---------------
// ------------->Write a blog article<-------------//
Route::get('/dashboard/posts/create', [
  'uses' => 'PostController@getPage',
  'as' => 'dashboard.posts',
]);

// ------------->Post a blog article<-------------//
Route::post('/dashboard/posts/create/new', [
  'uses' => 'PostController@createPost',
  'as' => 'post.create',
]);

// ------------->Read a blog article<-------------//
Route::get('/article/{id}', [
  'uses' => 'PostController@readPost',
  'as' => 'post.read',
]);

//Get a gallery of images uploaded for posts
Route::get('/dashboard/media', [
  'uses' => 'AdminController@getMedia',
  'as' => 'dashboard.media',
]);

//Get a list of all posts
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
