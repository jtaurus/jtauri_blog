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

Route::get('/', 'UserController@index_page');

// Logins:

Route::get('/user/login', 'UserController@login_page');
Route::post('/user/login', 'UserController@validate_login');
Route::get('/user/logout', 'UserController@logout');

// Registration:

Route::get('/user/create', 'UserController@registration_page');
Route::post('/user/create', 'UserController@register_user');

// Welcome page after logging in:

Route::get('/user/welcome_page', 'UserController@welcome_page');

// View user profile:

Route::get('/user/{id}/view_profile', ['uses' => 'UserController@view_user_profile']);

// Posting articles:

Route::get('/article/new', 'UserController@article_posting_page');
Route::post('/article/new', 'UserController@post_article');

// Viewing articles:

Route::get('/article/view/{id}', ['uses' => 'UserController@view_article']);

// Commenting articles:

Route::get('/article/view/{id}/comment', ['uses' => 'UserController@comment_article']);
Route::post('/article/view/{id}/comment', ['uses' => 'UserController@comment_article_add']);
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
