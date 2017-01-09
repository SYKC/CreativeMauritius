<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button id="menu-trigger2" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span id="menu-mobile" class="ion-navicon-round"> MENU</span>

            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Creative Mauritius') }}
            </a>
            <div id="small-menu-visible">
              <ul class="navbar-left" id="left-section">
                <li> Blog </li>
                <li> About Us </li>
                <li> Resources </li>
                <li> Interactive Map </li>
                <li> Inspiring Stories </li>
              </ul>
              <ul class="navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                  @else
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img class="navbar-avatar" src="{{ URL::to('/') }}/uploads/avatars/{{ Auth::user()->avatar}}" alt="{{ Auth::user()->username }}">
                              {{ Auth::user()->name }} <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu" role="menu">
                             <li>
                                  <a href="/user/{{ Auth::user()->username }}"> View Profile</a>
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
            </div>

        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <ul class="navbar-right">
            <span id="menu-trigger" class="ion-navicon-round"> MENU</span>
          </ul>
          <div id="mega-navigation">
            <div id="small-menu-mobile">
              <ul class="navbar-left">
                <li> Blog </li>
                <li> About Us </li>
                <li> Resources </li>
                <li> Interactive Map </li>
                <li> Inspiring Stories </li>
              </ul>
              <ul class="navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                  @else
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img class="navbar-avatar" src="{{ URL::to('/') }}/uploads/avatars/{{ Auth::user()->avatar}}" alt="{{ Auth::user()->username }}">
                              {{ Auth::user()->name }} <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu" role="menu">
                             <li>
                                  <a href="/user/{{ Auth::user()->username }}"> View Profile</a>
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
