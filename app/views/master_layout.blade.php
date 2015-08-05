<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<style>
	  body {
    padding-top: 60px;
  	}
  </style>
  @yield('head')
</head>
<body>


	
	@if(!Auth::check())
		@include('partials.nav_logged_out')
	@else
		@include('partials.nav_logged_in')
	@endif



	<div class="container">
	@yield('content')
	</div>

	@yield('footer')
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
