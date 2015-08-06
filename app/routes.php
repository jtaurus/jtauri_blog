<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'homepage', 'uses' => 'UserController@index_page');

// Logins:

Route::get('/user/login', ['as' => 'login', 'uses' => 'UserController@login_page']);
Route::post('/user/login', 'UserController@validate_login');

// Logout:

Route::get('/user/logout', ['as' => 'logout', 'uses' => 'UserController@logout']);

// Registration:

Route::get('/user/create', ['as' => 'registration', 'uses' => 'UserController@registration_page']);
Route::post('/user/create', 'UserController@register_user');

// Welcome page after logging in:

Route::get('/user/welcome_page', ['as' => 'welcome_page', 'uses' => 'UserController@welcome_page']);

// View user profile:

Route::get('/user/{id}/view_profile', ['as' => 'user_profile', 'uses' => 'UserController@view_user_profile']);

// Posting articles:

Route::get('/article/new', ['as' => 'article_posting_page', 'uses' => 'UserController@article_posting_page']);
Route::post('/article/new', 'UserController@post_article');

// Viewing articles:

Route::get('/article/view/{id}', ['as' => 'view_article', 'uses' => 'UserController@view_article']);

// Editing articles:

Route::get('/article/edit/{id}', [ 'as' => 'edit_article', 'uses' => 'UserController@view_edit_article_page']);
Route::post('article/edit/{id}', [ 'uses' => 'UserController@apply_edit_article_changes']);

// Deleting articles:

Route::get('/article/delete/{id}', [ 'as' => 'delete_article', 'uses' => 'UserController@delete_article']);

// Commenting articles:

Route::get('/article/view/{id}/comment', ['as' => 'comment_article', 'uses' => 'UserController@comment_article']);
Route::post('/article/view/{id}/comment', ['uses' => 'UserController@comment_article_add']);

// Deleting comments:

Route::get('/article/view/{article_id}/comment/{comment_id}/delete', ['as' => 'delete_article', 'uses' => 'UserController@delete_comment']);

Route::get('/test', function(){
	$oneUser = User::find(1);
	$usersPosts = $oneUser->posts()->get();
	foreach($usersPosts as $onePost){
		echo $onePost["title"];
		echo "<br />";
		echo $onePost["body"];
		echo "<br /><br />";
		$postsComments = $onePost->comments()->get();
		foreach($postsComments as $oneComment){
			echo $oneComment["body_comment"];
			echo "<br />";
		}
	}
});
