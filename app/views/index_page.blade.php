<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			text-align:center;
			color: #999;
		}

		.welcome {
			width: 300px;
			height: 200px;
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -150px;
			margin-top: -100px;
		}

		a, a:visited {
			text-decoration:none;
		}

		h1 {
			font-size: 32px;
			margin: 16px 0 0 0;
		}
	</style>
</head>
<body>
	@if(!$data["isLoggedIn"])
		<div align="right"><a href="./user/login">Login</a> | <a href="./user/create">Create account</a></div>
	@else
		<div align="right"><a href="./article/new">Post new article</a> | <a href="./user/logout">Logout</a></div>
	@endif
<center>
	@foreach($data["posts"] as $onePost)
		<p><a href="./article/view/{{{$onePost["id"]}}}">{{{$onePost["title"]}}}</a></p>
		<p>by: <a href="./user/{{{$onePost["author_id"]}}}/view_profile">{{{$onePost["author"]}}}</a></p>
		<p>{{{$onePost["body"]}}}</p>
	@endforeach
</center>
</body>
</html>
