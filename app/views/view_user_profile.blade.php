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
Username: {{{$data["username"]}}}<br />
E-mail: {{{$data["email"]}}}<br />
Registration date: {{{$data["registration_date"]}}}<br />
<h1>Latest posts:</h1><br />
@foreach($data["posts"] as $onePost)
	<center><h3><a href="/simple_blog/public/article/view/{{{$onePost["id"]}}}">{{{$onePost["title"]}}}</a></h3> <br />
	{{{$onePost["body"]}}} <br /></center>
@endforeach
<h1>Latest comments:</h1><br />
	<center>
@foreach($data["comments"] as $oneComment)
	<center><h3><a href="/simple_blog/public/article/view/{{{$oneComment["commented_post_id"]}}}">{{{$oneComment["commented_post_title"]}}}</a></h3> <br />
		<p>{{{$oneComment["body"]}}}</p>
@endforeach
	</center>
</body>
</html>
