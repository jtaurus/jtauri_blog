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

}