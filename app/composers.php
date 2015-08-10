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

View::composer('welcome_page', function($view){
	$userReference = Auth::user();
	$view->with('user', $userReference);
});

View::composer('view_article', function($view){
	$id = $view->getData()["id"];
	// fetch the article and display it
	$postInstance = Post::findOrFail($id);
	// fetch the comments
	$comments = $postInstance->comments()->paginate(10);
	$data["title"] = $postInstance["title"];
	$data["body"] = $postInstance["body"];
	$authorOfThePost = $postInstance->user()->get();
	$data["author"] = $authorOfThePost[0]["username"];
	$data["author_id"] = $authorOfThePost[0]["id"];
	$data["comments"] = $comments;
	$data["detailed_comments"] = array();
	$data["id"] = $postInstance["id"];
	$categoryInstance = $postInstance->categories()->get();
	$data["category_id"] = $categoryInstance[0]->id;
	$data["category_name"] = $categoryInstance[0]->category_name;
	foreach($comments as $oneComment){
			$postAuthor = $oneComment->user()->get();
			$moreData = $oneComment;
			$moreData["author"] = $postAuthor[0]["username"];
			$moreData["author_id"] = $postAuthor[0]["id"];
			$data["detailed_comments"][] = $moreData;
		}
	$data["pagination_links"] = $comments->links();
	$view->with('data', $data);
});