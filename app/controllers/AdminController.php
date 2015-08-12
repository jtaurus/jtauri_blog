<?php

class AdminController extends BaseController {

	public function admin_page(){
		if(Auth::user()["id"] == 1){
			Return View::make('admin_page');
		}
		else{
			Return Redirect::route('login');
		}
	}

	public function manage_users(){
		if(Auth::user()["id"] == 1){
			Return View::make('manage_users');
		}
		else{
			Return Redirect::route('login');
		}
	}

	public function ban_user($id){
		if(Auth::user()["id"] == 1){
			if($id != 1){
				$userReference = User::findOrFail($id);
				$usersPosts = $userReference->posts()->get();
				$usersComments = $userReference->comments()->get();
				foreach($usersPosts as $onePost){
					$onePost->delete();
				}
				foreach($usersComments as $oneComment){
					$oneComment->delete();
				}
				$userReference->delete();
				Return View::make('manage_users')->with('message', "User has been banned.");
				}
			else{
				Return View::make('manage_users')->with('message', 'Cannot ban admin.');
			}

		}
		else{
			Return Redirect::route('login');
		}
	}

	public function make_user_an_admin($id){
		if(!Auth::check() || !Auth::user()->isAdmin()){
			Return Redirect::route('login');
		}
		else{
			$userReference = User::findOrFail($id);
			$userReference->admin = true;
			$userReference->save();
			Return Redirect::route('manage_users');
		}
	}

}