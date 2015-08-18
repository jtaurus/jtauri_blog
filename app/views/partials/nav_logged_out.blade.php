<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
  <div class="container">
        <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/simple_blog/public/">JTauri</a>
    </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{URL::current()}}">Current page <span class="sr-only">(current)</span></a></li>
          <li><a href="{{route('login')}}">Login</a></li>
          @if(BlogConfig::getConfigValue('registration_enabled'))
          <li><a href="{{route('registration')}}">Sign-up</a></li>
          @endif
      </ul>
  </div>
</nav>