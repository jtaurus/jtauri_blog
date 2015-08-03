<?php

class UserController extends BaseController {

	public function login_page(){
		Return View::make('login');
	}

	public function validate_login(){
		
		// if logged in with valid credentials, authorize and redirect to main page:

		$enteredUsername = Request::input('username');
		$enteredPassword = Request::input('password');
		if(Auth::attempt(array('username' => $enteredUsername, 'password' => $enteredPassword))){
			//Return View::make('user_profile')->with('user', Auth::user());
			return Redirect::to('/user/profile');
		}
		// If unable to log in with valid credentials, send message about wrong authorization attempt:
		if(!Auth::attempt(array('username' => $enteredUsername, 'password' => $enteredPassword))){
			Return View::make('login')->with('message', "The details you've entered were invalid. Please try again.");
		}
	}

	public function registration_page(){
		Return View::make('registration_page');
	}

	public function register_user(){
		$newUser = new User;
		$newUser->username = Input::get('username');
		$newUser->password = Hash::make(Input::get('password'));
		$newUser->email = Input::get('email');
		$newUser->save();
		Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')));
		return Redirect::to('/user/profile');
		// otherwise show message about improper data

	}

	public function view_user_profile(){
		$user = Auth::user();
		if(Auth::check()){
			Return View::make('user_profile')->with('user', $user);
		}
		else{
			Return Redirect::to('/user/login');
		}
	}

	public function logout(){
		Auth::logout();
		Return View::make('logout');
	}

	public function article_posting_page(){
		if(!Auth::check()){
			Return Redirect::to('/user/login');
		}
		$username = Auth::user();
		$username = $username["username"];
		Return View::make('article_posting')->with('username', $username);
	}

	public function post_article(){
		if(!Auth::check()){
			Return Redirect::to('/user/login');
		}
		$postInstance = new Post;
		$postInstance->user_id = Auth::user()->id;
		$postInstance->title = Input::get('title');
		$postInstance->body = Input::get('body');
		$postInstance->save();
		$postId = $postInstance->id;
		Return Redirect::to('/article/view/' . $postId . '/');
		// After posting, redirect user to the article page
	}

	public function view_article($id){
		// fetch the article and display it
		$postInstance = Post::findOrFail($id);
		// fetch the comments
		$comments = $postInstance->comments()->get();
		$data["title"] = $postInstance["title"];
		$data["body"] = $postInstance["body"];
		$data["comments"] = $comments;
		$data["detailed_comments"] = array();
		$data["id"] = $postInstance["id"];
			foreach($comments as $oneComment){
			$postAuthor = $oneComment->user()->get();
			$moreData = $oneComment;
			$moreData["author"] = $postAuthor[0]["username"];
			$data["detailed_comments"][] = $moreData;
		}
		// if no post found with given id, make a 404 page:
		return View::make('view_article')->with('data', $data);
	}

	public function comment_article($id){
		$user = Auth::user();
		if(!Auth::check()){
			Return Redirect::to('/user/login');
		}
		else{
			$theArticle = Post::findOrFail($id);
			$theArticleText = $theArticle["body"];
			return View::make('comment_article')->with('article', $theArticleText);
		}
	}

	public function comment_article_add($id){
		$user = Auth::user();
		if(!Auth::check()){
			Return Redirect::to('/user/login');
		}
		else{
			$commentInstance = new Comment;
			$commentInstance->user_id = Auth::user()->id;
			$commentInstance->post_id = $id;
			$commentInstance->body_comment = Input::get('comment_body');
			$commentInstance->save();
			Return Redirect::to('/article/view/' . $id . '/');
		}
	}

	public function index_page(){
		$postsArray = Post::all();
		Return View::make('index_page')->with('data', $postsArray);
	}

}
