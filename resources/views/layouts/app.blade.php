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
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ secure_asset('css/ink-css/ink.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.js"></script>

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script src="{{ secure_asset('js/ink-js/ink-all.min.js') }}"></script>
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
          if (windowpos >= 700) {
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
        var navigation = $(".navbar-default");
        navigation.addClass("navbar-scroll");
      });
      </script>
    @endif

    <script>
    var data1 = document.getElementById("user-id").innerHTML
    var ctx = document.getElementById("my-progress")
    var progressChart = new Chart (ctx, {
      type: 'bar',
      data: {
        labels: ["Curious fellow", "Adventurer", "Explorer", "Enthusiast", "Historian", "Grandpa"],
        datasets: [{
          label: "Your score out of 50",
          data: [data1,35,46,38,42,20 ],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    });
    </script>
</body>
</html>
