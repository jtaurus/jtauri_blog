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
        <<li class="active"><a href="{{URL::current()}}">Current page <span class="sr-only">(current)</span></a></li>
          <li><a href="{{route('article_posting_page')}}">Post new article</a></li>
          <li><a href="{{route('logout')}}">Logout</a></li>
          <p class="navbar-text">You are signed in as <a href="{{route('user_profile', Auth::user()->id)}}">{{Auth::user()->username}}</a>.</p>
      </ul>
  </div>
</nav>