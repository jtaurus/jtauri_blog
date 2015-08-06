<?php

class UserController extends BaseController {

	public function login_page(){
		Session::put('intended_url', URL::previous());
		Return View::make('login');
	}

	public function validate_login(){
		
		// if logged in with valid credentials, authorize and redirect to main page:

		$enteredUsername = Request::input('username');
		$enteredPassword = Request::input('password');
		if(Auth::attempt(array('username' => $enteredUsername, 'password' => $enteredPassword))){
			//Return View::make('user_profile')->with('user', Auth::user());
			//return Redirect::to('/user/welcome_page');
			return Redirect::to(Session::get('intended_url'));
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
		return Redirect::route('welcome_page');
		// otherwise show message about improper data

	}

	public function welcome_page(){
		$user = Auth::user();
		if(Auth::check()){
			Return View::make('welcome_page')->with('user', $user);
		}
		else{
			Return Redirect::route('login');
		}
	}

	public function logout(){
		Auth::logout();
		Return Redirect::to(URL::previous());
		//Return View::make('logout')->with('data', URL::previous());
	}

	public function article_posting_page(){
		if(!Auth::check()){
			Return Redirect::route('login');
		}
		$username = Auth::user();
		$username = $username["username"];
		Return View::make('article_posting')->with('username', $username);
	}

	public function post_article(){
		if(!Auth::check()){
			Return Redirect::route('login');
		}
		$validatorInstance = Validator::make(
    	array('title' => Input::get('title'), 'body' => Input::get('body')),
    	array('title' => 'required', 'body' => 'required'));
		$postInstance = new Post;
		$postInstance->user_id = Auth::user()->id;
		$postInstance->title = Input::get('title');
		$postInstance->body = Input::get('body');
		if($validatorInstance->passes()){
			$postInstance->save();
			$postId = $postInstance->id;
			return Redirect::route('view_article', $postId);
		}
		else{
			Return View::make('article_posting')->with('message', "Please fill out every field properly.");
		}

		// After posting, redirect user to the article page
	}

	public function view_article($id){
		// fetch the article and display it
		$postInstance = Post::findOrFail($id);
		// fetch the comments
		$comments = $postInstance->comments()->get();
		$data["title"] = $postInstance["title"];
		$data["body"] = $postInstance["body"];
		$authorOfThePost = $postInstance->user()->get();
		$data["author"] = $authorOfThePost[0]["username"];
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
			Return Redirect::route('login');
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
			Return Redirect::route('login');
		}
		else{
			$commentInstance = new Comment;
			$commentInstance->user_id = Auth::user()->id;
			$commentInstance->post_id = $id;
			$commentInstance->body_comment = Input::get('comment_body');
			$commentInstance->save();
			Return Redirect::route('view_article', $id);
		}
	}

	public function index_page(){
		$postsArray = Post::orderBy('id', 'DESC')->get()->take(5);
		$sideBarLinks = array();
		$sidebarLinks = Post::orderBy('id', 'DESC')->get()->take(10);
		$counter = 0;
		foreach($sidebarLinks as $oneLink){
			$sideBarLinks[$counter]["title"] = $oneLink->title;
			$sideBarLinks[$counter]["id"] = $oneLink->id;
			$counter += 1;
		}
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
		$data["sidebar_links"] = $sideBarLinks;
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
		$data["posts"] = [];
		$data["comments"] = [];
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

	public function view_edit_article_page($id){
		$user = Auth::user();
		if(!Auth::check()){
			Return Redirect::route('login');
		}
		$postInstance = Post::findOrFail($id);
		$postAuthor = $postInstance->user()->get();
		if($user->username != $postAuthor[0]["username"]){
			Return Redirect::route('login');
		}
		$data["post_body"] = $postInstance->body;
		$data["post_title"] = $postInstance->title;
		Return View::make('article_edit')->with('data', $data);
	}

	public function apply_edit_article_changes($id){
		$postInstance = Post::findOrFail($id);
		$postInstance->title = Input::get('title');
		$postInstance->body = Input::get('body');
		$validatorInstance = Validator::make(
    	array('title' => Input::get('title'), 'body' => Input::get('body')),
    	array('title' => 'required', 'body' => 'required'));
    	if($validatorInstance->passes()){
			$postInstance->save();
			Return Redirect::to('./article/view/' . $id);
		}
		else{
			$data["post_body"] = $postInstance->body;
			$data["post_title"] = $postInstance->title;
			$data["message"] = "Please fill out every field correctly.";
			Return View::make('article_edit')->with('data', $data);
		}
	}

	public function delete_article($id){
		$postInstance = Post::findOrFail($id);
		$postAuthor = $postInstance->user()->get();
		if(Auth::user()->username != $postAuthor[0]->username){
			Return Redirect::to('/user/login');
		}
		else{
			// Also delete all comments:
			$commentsArray = $postInstance->comments()->get();
			foreach($commentsArray as $oneComment){
				Comment::destroy($oneComment->id);
			}
			Post::destroy($id);
			Return Redirect::to("../public/");
		}
	}

	public function delete_comment($article_id, $comment_id){
		$commentReference = Comment::findOrFail($comment_id);
		$commentsAuthor = $commentReference->user()->get();
		$commentsAuthor = $commentsAuthor[0];
		if(Auth::check() && Auth::user()->username == $commentsAuthor->username){
			Comment::destroy($comment_id);
			Return Redirect::to(URL::previous());
		}
		else{
			Return Redirect::to('/user/login');
		}
	}

}
