@extends('layouts.admin')
@section('content')
  <div class="container" id="admin-panel">
  <span class="ion-connection-bars"></span>
    <h5>
      Network Status:
    </h5>
    <span class="status-online">ONLINE</span>

    <div class="notifications">
      <span class="ion-ios-bell"></span> Notifications
    </div>

    <section class="dashboard-main">
    <div class="returning-user-container">
      <h1 id="user-firstname">Hello {{ Auth::user()->first_name }}.</h1>
      <div class="quick-insights-navigation">
      <ul class="horizontal-navigation">
          <li class="nav-items--publications" data-count="{{ Auth::user()->posts->count() }}">{{ Auth::user()->posts->count() }} Stories published</li>
          <li class="nav-items--followers">125 Followers</li>
          <li class="nav-items--collaborations">4 Collaborations</li>
      </ul>
      </div>
       <div class="top-banner">
         <h1>Got a story?</h1>
         <p>Start working on it, either alone or collaborate with someone.</p>
         <button class="get-started">Let's Go!</button>
       </div>
    </div>
      <div id="graph-container" style="min-width: 310px; height: 400px;"></div>
      <div class="row">
        <div class="col-md-4">
         <div class="insights-tab">
          <div class="insights-tab-header">
            <h3>Some insights</h3>
          </div>
          <div class="social-media-widget-container">
           <div class="social-media-widget center col-sm-6">
           <span class="social-media-widget-icon ion-social-twitter"></span>
             <h4>Twitter</h4>
             <p>21k Followers</p>
           </div>
           <div class="social-media-widget center col-sm-6">
           <span class="social-media-widget-icon ion-social-facebook"></span>
             <h4>Facebook</h4>
             <p>50k Likes</p>
           </div>
          </div><!--Social media widget container-->
           <div class="insights-tab-body">
            <p>New version 2.4.2 available!</p>
            <h4>200+ articles written</h4>
          </div>
        </div>
      </div>
      <!-- $.getJSON('https://newsapi.org/v1/articles?source=techcrunch&apiKey=77303da420f54be38222c0493e7a21ad',function(data) {
       console.log(data.articles);
      }); -->
      </div><!--End of row-->

      <div class="row">
        @foreach ($posts->sortByDesc('id')->slice(0,3) as $post)
        <div class="col-md-4 latest-posts-body">
         <figure>
           <img class="dashboard-post-cover" src="{{ URL::secure('/') }}/uploads/covers/{{ $post->featured_image }}">
           <figcaption class="latest-posts-excerpt">
             <h3>
               {{ $post->title }}
             </h3>
             <p>
               {{ substr($post->body, 0, 120) }}...
             </p>
           </figcaption>
         </figure>
        </div>
        @endforeach
      </div>
    </section>
    <script>
    Highcharts.chart('graph-container', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Pageviews by browser agent'
    },
    subtitle: {
        text: 'Market data identifying broswer agents'
    },
    xAxis: {
        type: 'datetime',
        dateTimeLabelFormats: { // don't display the dummy year
            month: '%e. %b',
            year: '%b'
        },
        title: {
            text: 'Date'
        }
    },
    yAxis: {
        title: {
            text: 'Visitors per month'
        },
        min: 0
    },
    tooltip: {
        headerFormat: '<b>{series.name}</b><br>',
        pointFormat: '{point.x:%e. %b}: {point.y:.2f} m'
    },

    plotOptions: {
        spline: {
            marker: {
                enabled: true
            }
        }
    },

    series: [{
        name: 'Mozilla Firefox > v52',
        // Define the data points. All series have a dummy year
        // of 1970/71 in order to be compared on the same x axis. Note
        // that in JavaScript, months start at 0 for January, 1 for February etc.
        data: [
            [Date.UTC(1970, 9, 21), 0],
            [Date.UTC(1970, 10, 4), 0.28],
            [Date.UTC(1970, 10, 9), 0.25],
            [Date.UTC(1970, 10, 27), 0.2],
            [Date.UTC(1970, 11, 2), 0.28],
            [Date.UTC(1970, 11, 26), 0.28],
            [Date.UTC(1970, 11, 29), 0.47],
            [Date.UTC(1971, 0, 11), 0.79],
            [Date.UTC(1971, 0, 26), 0.72],
            [Date.UTC(1971, 1, 3), 1.02],
            [Date.UTC(1971, 1, 11), 1.12],
            [Date.UTC(1971, 1, 25), 1.2],
            [Date.UTC(1971, 2, 11), 1.18],
            [Date.UTC(1971, 3, 11), 1.19],
            [Date.UTC(1971, 4, 1), 1.85],
            [Date.UTC(1971, 4, 5), 2.22],
            [Date.UTC(1971, 4, 19), 1.15],
            [Date.UTC(1971, 5, 3), 0]
        ]
    }, {
        name: 'Chrome/Chromium',
        data: [
            [Date.UTC(1970, 9, 29), 0],
            [Date.UTC(1970, 10, 9), 0.4],
            [Date.UTC(1970, 11, 1), 0.25],
            [Date.UTC(1971, 0, 1), 1.66],
            [Date.UTC(1971, 0, 10), 1.8],
            [Date.UTC(1971, 1, 19), 1.76],
            [Date.UTC(1971, 2, 25), 2.62],
            [Date.UTC(1971, 3, 19), 2.41],
            [Date.UTC(1971, 3, 30), 2.05],
            [Date.UTC(1971, 4, 14), 1.7],
            [Date.UTC(1971, 4, 24), 1.1],
            [Date.UTC(1971, 5, 10), 0]
        ]
    }, {
        name: 'IE > v8',
        data: [
            [Date.UTC(1970, 10, 25), 0],
            [Date.UTC(1970, 11, 6), 0.25],
            [Date.UTC(1970, 11, 20), 1.41],
            [Date.UTC(1970, 11, 25), 1.64],
            [Date.UTC(1971, 0, 4), 1.6],
            [Date.UTC(1971, 0, 17), 2.55],
            [Date.UTC(1971, 0, 24), 2.62],
            [Date.UTC(1971, 1, 4), 2.5],
            [Date.UTC(1971, 1, 14), 2.42],
            [Date.UTC(1971, 2, 6), 2.74],
            [Date.UTC(1971, 2, 14), 2.62],
            [Date.UTC(1971, 2, 24), 2.6],
            [Date.UTC(1971, 3, 2), 2.81],
            [Date.UTC(1971, 3, 12), 2.63],
            [Date.UTC(1971, 3, 28), 2.77],
            [Date.UTC(1971, 4, 5), 2.68],
            [Date.UTC(1971, 4, 10), 2.56],
            [Date.UTC(1971, 4, 15), 2.39],
            [Date.UTC(1971, 4, 20), 2.3],
            [Date.UTC(1971, 5, 5), 2],
            [Date.UTC(1971, 5, 10), 1.85],
            [Date.UTC(1971, 5, 15), 1.49],
            [Date.UTC(1971, 5, 23), 1.08]
        ]
    }]
});
    </script>
@endsection
