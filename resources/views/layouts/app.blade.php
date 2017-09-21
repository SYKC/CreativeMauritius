<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Creative Mauritius') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Jaldi" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Yeseva+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,500,900" rel="stylesheet" type="text/css">
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/ink-css/ink.min.css') }}">

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script src="{{ asset('js/ink-js/ink-all.min.js') }}"></script>
</head>
<body>
  @include('includes.navigation')
    <div id="app">


        @yield('content')

    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>

    @if(Request::url() === URL::secure('home') || Request::url() === URL::to('home'))
      <script>
      //applies blur filter on parallax image while scrolling
          $(window).on('scroll', function () {
          var pixs = $(document).scrollTop()
          pixs = pixs / 500;
          $(".showcase-container").css({"-webkit-filter": "grayscale("+pixs+")","filter": "grayscale("+pixs+")" })
      });
      </script>

      <script>
      $(document).ready(function() {
        var navigation = $(".navbar-default");
        var logo = $(".logo-navbar");
        var pos = navigation.position();
        $(window).scroll(function() {
          var windowpos = $(window).scrollTop();
          if (windowpos >= 100) {
            navigation.addClass("navbar-scroll");
            logo.addClass("scroll-show")
          } else {
            navigation.removeClass("navbar-scroll");
            logo.removeClass("scroll-show");
          }
        });
      });
      </script>
    @else
      <script>
      $(document).ready(function() {
        var logo = $(".logo-navbar");
        logo.css("opacity","1");
        var navigation = $(".navbar-default");
        navigation.addClass("navbar-scroll");
      });
      </script>
    @endif

    <script>
    if ($('#article-header').length > 0) {
      $(document).ready(function() {
        var title = $(".article-title").text();
        var unstyled =$("#article-title-section");
        var menulist = $("li.main-menu-items");
        var flag = false;
        $(window).scroll(function() {
          var windowpos = $(window).scrollTop();
          if (windowpos >= 100) {
            unstyled.css({"display": "inline-block", "opacity": "1 !important"});
            menulist.addClass("article-title-wrapper");
            if(!flag){
              unstyled.append(title);
              flag = true;
            }
          } else {
            unstyled.css("display", "none");
            menulist.removeClass("article-title-wrapper");
          }
        });
      });
    }
    </script>
</body>
</html>
