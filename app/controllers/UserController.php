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
			return Redirect::to('/user/welcome_page');
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

	public function welcome_page(){
		$user = Auth::user();
		if(Auth::check()){
			Return View::make('welcome_page')->with('user', $user);
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
			$moreData["author_id"] = $postAuthor[0]["id"];
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
		$counter = 0;
		foreach($postsArray as $onePost){
			$userReference = $onePost->user()->get();
			$postsArray[$counter]["author"] = $userReference[0]->username;
			$postsArray[$counter]["author_id"] = $userReference[0]->id;
			$counter += 1;
		}
		// pass whether the user is logged in or not:
		$data["isLoggedIn"] = Auth::check();
		$data["posts"] = $postsArray;
		Return View::make('index_page')->with('data', $data);
	}

	public function view_user_profile($id){
		$userReference = User::findOrFail($id);
		$data["username"] = $userReference->username;
		$data["email"] = $userReference->email;
		$data["registration_date"] = $userReference->created_at;
		// find users posts:
		$userPostsAll = $userReference->posts()->get();
		$userCommentsAll = $userReference->comments()->get();
		$counter = 0;
		foreach($userPostsAll as $onePost){
			$data["posts"][$counter]["id"] = $onePost->id;
			$data["posts"][$counter]["title"] = $onePost->title;
			$data["posts"][$counter]["body"] = $onePost->body;
			$data["posts"][$counter]["post_date"] = $onePost->created_at;
			$counter += 1;
		}
		$counter = 0;
		foreach($userCommentsAll as $oneComment){
			$commentedPostReference = $oneComment->post()->get();
			$data["comments"][$counter]["body"] = $oneComment->body_comment;
			$data["comments"][$counter]["comment_post_date"] = $oneComment->created_at;
			$data["comments"][$counter]["commented_post_id"] = $commentedPostReference[0]->id;
			$data["comments"][$counter]["commented_post_title"] = $commentedPostReference[0]->title;
			$counter += 1;
		}
		Return View::make('view_user_profile')->with('data', $data);
	}

}
