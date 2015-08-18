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
	$data["post"] = Post::findOrFail($id);
	$data["author"] = $data["post"]->user()->first();
	$data["category"] = $data["post"]->categories()->first();
	$data["comments"] = $data["post"]->comments()->paginate(10);
	$data["pagination_links"] = $data["post"]->comments()->paginate(10)->links();
	$view->with('data', $data);
});

View::composer('comment_article', function($view){
	$id = $view->getData()["id"];
	$theArticle = Post::findOrFail($id);
	$theArticleText = $theArticle["body"];
	$view->with('article', $theArticleText);
});

View::composer('index_page', function($view){
	$postsArray = Post::where('moderated', '=', true)->orderBy('id', 'DESC')->paginate(5);
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
			$userReference = $onePost->user()->first();
			$postsArray[$counter]["author"] = $userReference->username;
			$postsArray[$counter]["author_id"] = $userReference->id;
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
			$commentedPostReference = $oneComment->post()->first();
			$data["comments"][$counter]["body"] = $oneComment->body_comment;
			$data["comments"][$counter]["comment_post_date"] = $oneComment->created_at;
			$data["comments"][$counter]["commented_post_id"] = $commentedPostReference->id;
			$data["comments"][$counter]["commented_post_title"] = $commentedPostReference->title;
			$counter += 1;
	}
	$view->with('data', $data);
});

View::composer('article_edit', function($view){
	$id = $view->getData()["data"]["id"];
	if(isset($view->getData()["data"]["message"])){
		$data["message"] = $view->getData()["data"]["message"];
	}
	$postInstance = Post::findOrFail($id);
	$data["post_body"] = $postInstance->body;
	$data["post_title"] = $postInstance->title;
	$view->with('data', $data);
});

View::composer('category_view', function($view){
	$id = $view->getData()["id"];
	$categoryReference = Category::findOrFail($id);
	$data["category_name"] = $categoryReference->category_name;
	$postsArray = $categoryReference->post()->paginate(5);
	$counter = 0;
	foreach($postsArray as $onePost){
			$authorReference = $onePost->user()->first();
			$postsArray[$counter]["author"] = $authorReference->username;
			$postsArray[$counter]["author_id"] = $authorReference->id;
			$counter += 1;
	}
	$data["posts"] = $postsArray;
	$view->with('data', $data);
});

View::composer('admin_page', function($view){
	$recentPosts = Post::orderBy('id', 'DESC')->get()->take(10);
	foreach($recentPosts as $onePost){
		$data["posts"][] = $onePost;
	}
	$unmoderatedPosts = Post::where('moderated', '=', false)->orderBY('id', 'DESC')->get()->take(10);
	foreach($unmoderatedPosts as $onePost){
		$data["unmoderated"][] = $onePost;
	}
	$recentComments = Comment::orderBy('id', 'DESC')->get()->take(10);
	foreach($recentComments as $oneComment){
		$data["comments"][] = $oneComment;
	}
	$view->with('data', $data);
});

View::composer('manage_users', function($view){
	$usersList = User::orderBy('id', 'DESC')->paginate(5);
	$data["users"] = $usersList;
	$view->with('data', $data);
});