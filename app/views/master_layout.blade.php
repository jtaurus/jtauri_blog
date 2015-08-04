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
		<div align="left"><a href="/simple_blog/public/">Home</a></div>
	@if(!Auth::check())
		<div align="right"><a href="/simple_blog/public/user/login">Login</a> | <a href="/simple_blog/public/user/create">Create account</a></div>
	@else
		<div align="right"><a href="/simple_blog/public/article/new">Post new article</a> | <a href="/simple_blog/public/user/logout">Logout</a></div>
	@endif

	@yield('content')

	@yield('footer')
</body>
</html>
