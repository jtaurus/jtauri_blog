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

View::composer('comment_article', function($view){
	$id = $view->getData()["id"];
	$theArticle = Post::findOrFail($id);
	$theArticleText = $theArticle["body"];
	$view->with('article', $theArticleText);
});

View::composer('index_page', function($view){
	$postsArray = Post::orderBy('id', 'DESC')->paginate(5);
	$sideBarLinks = array();
	$sidebarLinks = Post::orderBy('id', 'DESC')->get()->take(10);
	$categoryLinks = Category::orderBy('id', 'DESC')->get()->take(5);
	$counter = 0;
	foreach($categoryLinks as $oneCategory){
			$categoryLinksArray[$counter]["id"] = $oneCategory->id;
			$categoryLinksArray[$counter]["name"] = $oneCategory->category_name;
			$counter += 1;
	}
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
	$data["category_links"] = $categoryLinksArray;
	$view->with('data', $data);
});

View::composer('view_user_profile', function($view){
	$id = $view->getData()["id"];
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
	$view->with('data', $data);
});