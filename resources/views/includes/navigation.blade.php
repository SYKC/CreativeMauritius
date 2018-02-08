<nav class="navbar fixed-top navbar-default navbar-expand-lg navbar-scroll">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">
        <img class="logo-navbar" src="https://res.cloudinary.com/xdisrupt/image/upload/v1484905525/creativemauritius.com/Final_Logo_transparent.png" alt="Creative Mauritius">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
                      <ul class="navbar-left" id="left-section">
                <li class="main-menu-items"> Blog </li>
                <li class="main-menu-items"> Projects </li>
                <li class="main-menu-items"> Resources </li>
                <li class="main-menu-items"> Collective </li>
                <span id="article-title-section"></span>
              </ul>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="navbar-right navbar-avatar-container">
              @if (Auth::guest())
                <div class="auth">
                  <li><a href="{{ url('/login') }}">Login</a></li>
                  <span> / </span>
                  <li><a href="{{ url('/register') }}">Register</a></li>
                </div>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          <img class="navbar-avatar" src="{{ url('/') }}/uploads/avatars/{{ Auth::user()->avatar}}" alt="{{ Auth::user()->username }}">
                            <span class="caret"></span> <span class="navbar-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-user-menu" role="menu">
                           <li>
                                <a href="{{ url('/') }}/user/{{ Auth::user()->username }}"> View Profile</a>
                           </li>

                            <li>
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>