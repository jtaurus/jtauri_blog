<?php

View::composer('article_posting', function($view){
	$userReference = Auth::user();
	$data["username"] = $userReference->username;
	$categoriesList = Category::all();
	foreach($categoriesList as $oneCategory){
		$data["categories"][$oneCategory->id] = $oneCategory->category_name;
	}
	$view->with('data', $data);
});