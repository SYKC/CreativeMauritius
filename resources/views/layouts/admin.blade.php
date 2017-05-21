<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Creative Mauritius') }}</title>

    <!-- Core jQuery files-->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Bevan" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,500,900" rel="stylesheet" type="text/css">
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">

    <!-- Styles (DataTables)-->
    <link href="{{ secure_asset('css/ink-css/ink.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">

    <!-- Scripts (Charts.js && Highcharts.js && DataTables) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

    <!-- UiKit -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.4/css/uikit.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.4/js/uikit.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.4/css/components/htmleditor.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.4/js/components/htmleditor.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.4/css/components/notify.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.4/js/components/notify.min.js"></script>

    <!-- UiKit HTML Editor dependencies-->

    <!-- Dependency: CodeMirror -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.22.0/codemirror.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.22.0/codemirror.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.22.0/mode/markdown/markdown.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.22.0/addon/mode/overlay.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.22.0/mode/xml/xml.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.22.0/mode/gfm/gfm.js"></script>

    <!-- Dependency: Marked -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.6/marked.min.js"></script>

    <!-- Loading separate Bootstrap minified JS due to app.js causing conflicts-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/medium-editor/latest/js/medium-editor.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/medium-editor/latest/css/medium-editor.min.css" type="text/css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/medium-editor/5.22.1/css/themes/beagle.min.css" type="text/css" media="screen" charset="utf-8">
    

    <!-- Firebase -->
    <script src="https://www.gstatic.com/firebasejs/3.3.0/firebase.js"></script>

    <!-- CodeMirror -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.17.0/codemirror.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.17.0/codemirror.css"/>

    <!-- Firepad -->
    <link rel="stylesheet" href="https://cdn.firebase.com/libs/firepad/1.4.0/firepad.css" />
    <script src="https://cdn.firebase.com/libs/firepad/1.4.0/firepad.min.js"></script>

    <!-- CKEditor -->
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

    <!-- Core CSS files -->
    <link href="{{ secure_asset('css/admin.css') }}" rel="stylesheet" type="text/css">

    <script src="{{ secure_asset('js/functions.js') }}"></script>


</head>
<body onload="init();">
  @include('includes.admin-navbar')
    <div id="app">


        @yield('content')

    </div>

    <script>
    $(document).ready(function() {
      $('dropdown-toggle').dropdown()
    });
    </script>

    <!-- Scripts -->
    <script>
    $(document).ready( function () {
      $('#posts_table').DataTable();
    });
    </script>
</body>
</html>
