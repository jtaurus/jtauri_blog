<?php

View::composer('article_posting', function($view){
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
	$view->with('article', $theArticle);
});

View::composer('index_page', function($view){
	$data["posts"] = Post::where('moderated', '=', true)->orderBy('id', 'DESC')->paginate(5);
	$data["sidebar_links"] = Post::orderBy('id', 'DESC')->get()->take(10);
	$data["category_links"] = Category::orderBy('id', 'DESC')->get()->take(5);
	$view->with('data', $data);
});

View::composer('view_user_profile', function($view){
	$id = $view->getData()["id"];
	$data["user"] = User::findOrFail($id);
	$data["posts"] = $data["user"]->posts()->get();
	$data["comments"] = $data["user"]->comments()->get();
	$view->with('data', $data);
});

View::composer('article_edit', function($view){
	$id = $view->getData()["data"]["id"];
	if(isset($view->getData()["data"]["message"])){
		$data["message"] = $view->getData()["data"]["message"];
	}
    $data["post"] = Post::findOrFail($id);
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