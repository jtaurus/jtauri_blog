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
<center>Article title: {{{$data["title"]}}}<br /><br />
Article body:{{{$data["body"]}}}<br /><br />
Comments:
@foreach ($data["detailed_comments"] as $oneComment)
	<p>{{{$oneComment["body_comment"] }}} posted on {{{$oneComment["created_at"]}}} by: <a href="/simple_blog/public/user/{{{$oneComment["author_id"]}}}/view_profile">{{{$oneComment["author"]}}}</a></p>
@endforeach
<br /><br />
<a href="./{{{$data["id"]}}}/comment">Add comment to this article</a>
</center>
</body>
</html>
