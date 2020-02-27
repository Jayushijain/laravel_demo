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

Route::get('/', function ()
{
	return view('welcome');
});

//To open post
Route::get('/post/{id}', ['as' => 'home.post', 'uses' => 'PostsController@post']);

//For all authentication functions.
Auth::routes();

//For logout.
Route::get('/logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'admin'], function ()
{
	Route::get('/admin', function ()
	{
		return view('admin.index');
	});

	Route::resource('/admin/users', 'UsersController', ['names' => [
		'index'  => 'admin.users.index',
		'create' => 'admin.users.create',
		'store'  => 'admin.users.store',
		'edit'   => 'admin.users.edit'
	]]);
	Route::resource('/admin/posts', 'PostsController', ['names' => [
		'index'  => 'admin.posts.index',
		'create' => 'admin.posts.create',
		'store'  => 'admin.posts.store',
		'edit'   => 'admin.posts.edit'
	]]);
	Route::resource('/admin/categories', 'CategoriesController', ['names' => [
		'index'  => 'admin.categories.index',
		'create' => 'admin.categories.create',
		'store'  => 'admin.categories.store',
		'edit'   => 'admin.categories.edit'
	]]);
	Route::resource('/admin/medias', 'MediasController', ['names' => [
		'index'  => 'admin.medias.index',
		'create' => 'admin.medias.create',
		'store'  => 'admin.medias.store',
		'edit'   => 'admin.medias.edit'
	]]);
	Route::resource('/admin/comments', 'PostCommentsController', ['names' => [
		'index'  => 'admin.comments.index',
		'create' => 'admin.comments.create',
		'store'  => 'admin.comments.store',
		'edit'   => 'admin.comments.edit',
		'show'   => 'admin.comments.show'
	]]);
	Route::resource('/admin/comment/replies', 'CommentRepliesController', ['names' => [
		'index'  => 'admin.replies.index',
		'create' => 'admin.replies.create',
		'store'  => 'admin.replies.store',
		'edit'   => 'admin.replies.edit',
		'show'  => 	'admin.comment.replies.show'
	]]);
});

//To open replies page and to auntheticate it
Route::group(['middleware' => 'auth'], function ()
{
	Route::post('/comment/reply', 'CommentRepliesController@createReply');

});
