<?php

class UserController extends BaseController {

	public function login_page(){
		Session::put('intended_url', URL::previous());
		Return View::make('login');
	}

	public function validate_login(){

		$enteredUsername = Request::input('username');
		$enteredPassword = Request::input('password');
		if(Auth::attempt(array('username' => $enteredUsername, 'password' => $enteredPassword))){
			return Redirect::to(Session::get('intended_url'));
		}
		// If unable to log in with valid credentials, send message about wrong authorization attempt:
		if(!Auth::attempt(array('username' => $enteredUsername, 'password' => $enteredPassword))){
			Return View::make('login')->with('message', "The details you've entered were invalid. Please try again.");
		}
	}

	public function registration_page(){
		if(!BlogConfig::getConfigValue('registration_enabled')){
			Return Redirect::route('home');
		}
		Return View::make('registration_page');
	}

	public function register_user(){
		if(!BlogConfig::getConfigValue('registration_enabled')){
			Return Redirect::route('home');
		}
		$newUser = new User;
		$newUser->username = Input::get('username');
		$newUser->password = Hash::make(Input::get('password'));
		$newUser->email = Input::get('email');
		$newUser->save();
		Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')));
		return Redirect::route('welcome_page');
	}

	public function welcome_page(){
		if(Auth::check()){
			Return View::make('welcome_page');
		}
		else{
			Return Redirect::route('login');
		}
	}

	public function logout(){
		Auth::logout();
		Return Redirect::to(URL::previous());
	}

	public function article_posting_page(){
		if(!Auth::check() || !Auth::user()->isAdmin() && !BlogConfig::getConfigValue('user_posting_enabled')){
			Return Redirect::route('login');
		}
		Return View::make('article_posting');
	}

	public function post_article(){
		if(!Auth::check() || !Auth::user()->isAdmin() && !BlogConfig::getConfigValue('user_posting_enabled')){
			Return Redirect::route('login');
		}
		$validatorInstance = Validator::make(
    	array('title' => Input::get('title'), 'body' => Input::get('body')),
    	array('title' => 'required', 'body' => 'required'));
		$postInstance = new Post;
		$postInstance->user_id = Auth::user()->id;
		$postInstance->title = Input::get('title');
		$postInstance->body = Input::get('body');
		$postInstance->category_id = Input::get('categories');
		if(!Auth::user()->isAdmin()){
		$postInstance->moderated = false;
		}
		else{
		$postInstance->moderated = true;	
		}
		if($validatorInstance->passes()){
			$postInstance->save();
			$postId = $postInstance->id;
			return Redirect::route('view_article', $postId);
		}
		else{
			Return View::make('article_posting')->with('message', "Please fill out every field properly.");
		}
	}

	public function view_article($id){
		return View::make('view_article')->with('id', $id);
	}

	public function comment_article($id){
		if(!Auth::check()){
			Return Redirect::route('login');
		}
		else{
			return View::make('comment_article')->with('id', $id);
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
		Return View::make('index_page');
	}

	public function view_user_profile($id){
		Return View::make('view_user_profile')->with('id', $id);
	}

	public function view_edit_article_page($id){
		$user = Auth::user();
		if(!Auth::check() || !Auth::user()->isAdmin() && !BlogConfig::getConfigValue('user_can_edit_posts')){
			Return Redirect::route('login');
		}
		$postInstance = Post::findOrFail($id);
		$postAuthor = $postInstance->user()->first();
		if(!Auth::user()->isAdmin() && $user->username != $postAuthor["username"]){
			Return Redirect::route('login');
		}
		$data["id"] = $id;
		Return View::make('article_edit')->with('data', $data);
	}

	public function apply_edit_article_changes($id){
		if(!Auth::check() || !Auth::user()->isAdmin() && !BlogConfig::getConfigValue('user_can_edit_posts')){
			Return Redirect::route('login');
		}
		$postInstance = Post::findOrFail($id);
		$postInstance->title = Input::get('title');
		$postInstance->body = Input::get('body');
		$validatorInstance = Validator::make(
    	array('title' => Input::get('title'), 'body' => Input::get('body')),
    	array('title' => 'required', 'body' => 'required'));
    	if($validatorInstance->passes()){
			$postInstance->save();
			Return Redirect::route('view_article', $id);
		}
		else{
			$data["message"] = "Please fill out every field correctly.";
			$data["id"] = $postInstance->id;
			Return View::make('article_edit')->with('data', $data);
		}
	}

	public function delete_article($id){
		$postInstance = Post::findOrFail($id);
		$postAuthor = $postInstance->user()->first();
		if(!Auth::user()->isAdmin() && Auth::user()->username != $postAuthor->username){
			Return Redirect::route('login');
		}
		else{
			// Also delete all comments:
			$commentsArray = $postInstance->comments()->get();
			foreach($commentsArray as $oneComment){
				Comment::destroy($oneComment->id);
			}
			Post::destroy($id);
			Return Redirect::route("home");
		}
	}

	public function delete_comment($article_id, $comment_id){
		$commentReference = Comment::findOrFail($comment_id);
		$commentsAuthor = $commentReference->user()->first();
		$commentsAuthor = $commentsAuthor;
		if(Auth::check() && Auth::user()->username == $commentsAuthor->username || Auth::user()->isAdmin()){
			Comment::destroy($comment_id);
			Return Redirect::to(URL::previous());
		}
		else{
			Return Redirect::route('login');
		}
	}

	public function view_category($id){
		Return View::make('category_view')->with('id', $id);
	}

}
