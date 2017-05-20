<nav role="navigation" class="navbar navbar-default navbar-fixed-bottom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--Logo-->

        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li id="home-menu"><a href="/dashboard"><i class="icon-set ion-ios-analytics-outline"></i><span class="menu-caption"> Dashboard </span></a></li>
                <li><a href="{{ route('dashboard.posts') }}"><i class="icon-set ion-ios-compose-outline"><span class="menu-caption"> New Post </span></i></a></li>
                <li><a href="{{ route('dashboard.written') }}"><i class="icon-set ion-ios-list-outline"><span class="menu-caption"> Articles </span></i></a></li>
                <li><a href="{{ route('dashboard.media') }}"><i class="icon-set ion-ios-camera-outline"><span class="menu-caption"> Media </span></i></a></li>
                <li><a href="{{ route('dashboard.posts') }}"><i class="icon-set ion-ios-pie-outline"><span class="menu-caption"> Stats </span></i></a></li>
                <li><a href="{{ route('dashboard.posts') }}"><i class="icon-set ion-ios-pulse"><span class="menu-caption"> Network </span></i></a></li>
            </ul>
            <ul class="navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          {{ Auth::user()->name }}
                          <strong class="permission">Level 5 Administrator</strong>
                          <img class="navbar-avatar" src="{{ URL::secure('/') }}/uploads/avatars/{{ Auth::user()->avatar}}" alt="{{ Auth::user()->username }}">
                          <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                           <li>
                                <a href="/user/{{ Auth::user()->username }}"> View Profile</a>
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
            </ul>
        </div>
    </div>
</nav>
