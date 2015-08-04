<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>


		<div align="left"><a href="/simple_blog/public/">Home</a></div>
	@if(!Auth::check())
		<div align="right"><a href="/simple_blog/public/user/login">Login</a> | <a href="/simple_blog/public/user/create">Create account</a></div>
	@else
		<div align="right"><a href="/simple_blog/public/article/new">Post new article</a> | <a href="/simple_blog/public/user/logout">Logout</a></div>
	@endif

	<div class="container">
	@yield('content')
	</div>

	@yield('footer')
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
