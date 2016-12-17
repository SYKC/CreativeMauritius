<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
  <!-- Styles -->
  <link href="css/app.css" rel="stylesheet" type="text/css">
  <link href="{{ URL::asset('css/ink-css/ink.min.css') }}">
  <!--Scripts-->
  <script src="{{ URL::asset('js/ink-js/ink-all.min.js') }}"></script>
</head>


<body>
  @include('includes.navigation')
  @yield('content')
  @show
</body>
</html>
