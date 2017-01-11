<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Mobile Collapsed Hamburger -->
            <button id="menu-trigger2" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span id="menu-mobile-visible" class="ion-navicon-round"> MENU</span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">

            </a>
            <div id="small-menu-visible">
              <ul class="navbar-left" id="left-section">
                <li class="main-menu-items"> Blog </li>
                <li class="main-menu-items"> About Us </li>
                <li class="main-menu-items"> Resources </li>
                <li class="main-menu-items"> Interactive Map </li>
                <li class="main-menu-items"> Inspiring Stories </li>
              </ul>
            </div>

        </div>

        <!-- Menu button desktop -->
          <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="navbar-right">
              <span id="menu-trigger" class="ion-navicon-round"> MENU</span>
            </ul>

            <ul class="navbar-right navbar-avatar-container">
              @if (Auth::guest())
                <div class="auth">
                  <li><a href="{{ URL::secure('/login') }}">Login</a></li>
                  <span> / </span>
                  <li><a href="{{ URL::secure('/register') }}">Register</a></li>
                </div>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          <img class="navbar-avatar" src="{{ URL::secure('/') }}/uploads/avatars/{{ Auth::user()->avatar}}" alt="{{ Auth::user()->username }}">
                            <span class="caret"></span> <span class="navbar-name">{{ Auth::user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                           <li>
                                <a href="{{ URL::secure('/') }}/user/{{ Auth::user()->username }}"> View Profile</a>
                           </li>

                            <li>
                                <a href="{{ URL::secure('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ URL::secure('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>

          <div id="mega-navigation">
            <ul class="navbar-right navbar-avatar-container-mobile">
              @if (Auth::guest())
                  <li><a href="{{ URL::secure('/login') }}">Login</a></li>
                  <li><a href="{{ URL::secure('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          <img class="navbar-avatar" src="{{ URL::secure('/') }}/uploads/avatars/{{ Auth::user()->avatar}}" alt="{{ Auth::user()->username }}">
                            <span class="caret"></span> <span class="navbar-name">{{ Auth::user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                           <li>
                                <a href="{{ URL::secure('/') }}/user/{{ Auth::user()->username }}"> View Profile</a>
                           </li>

                            <li>
                                <a href="{{ URL::secure('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ URL::secure('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
            <div id="main-menu">
              <!--Responsive menu content-->
            </div>
            <div id="large-menu">
              <div class="categories">

                <div class="menu-category-grid" id="art">
                  <h1>ART</h1>
                </div>

                <div class="menu-category-grid" id="culture">
                  <h1>CULTURE</h1>
                </div>

                <div class="menu-category-grid" id="history">
                  <h1>HISTORY</h1>
                </div>

              </div>
            </div>
          </div>
        </div>
    </div>
</nav>

<script>
$('#menu-trigger').click(function() {
  $('#mega-navigation').slideToggle('slow', function () {

  });
});
</script>

<script>
$('#menu-trigger2').click(function() {
  $('#mega-navigation').slideToggle('slow', function () {

  });
});
</script>
