<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function ()
{
	return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/post/{id}',['as'=>'home.post','uses'=>'PostsController@post']);

Route::group(['middleware' => 'admin'], function ()
{
	Route::get('/admin', function ()
	{
		return view('admin.index');
	});

	Route::resource('/admin/users', 'UsersController');
	Route::resource('/admin/posts', 'PostsController');
	Route::resource('/admin/categories', 'CategoriesController');
	Route::resource('/admin/medias', 'MediasController');
	Route::resource('/admin/comments', 'PostCommentsController');
	Route::resource('/admin/comment/replies', 'CommentRepliesController');

	// Route::get('admin/media/upload',['as'=>'admin.media.upload','uses'=>'MediasController@store']);
});

Route::group(['middleware' => 'auth'], function ()
{
	Route::post('/comment/reply', 'CommentRepliesController@createReply');

});