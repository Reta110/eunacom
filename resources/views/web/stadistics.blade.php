<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="icon" href="../../favicon.ico">
      <link rel="stylesheet" href="{{asset('css/funkradio.css')}}">
      <link rel="stylesheet" href="{{asset('css/counters.css')}}">
      <title>Preguntas Eunacom</title>
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <!-- Optional theme -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
      <style>
         /* CSS REQUIRED */
         .state-icon {
         left: -5px;
         }
         .list-group-item-primary {
         color: rgb(255, 255, 255);
         background-color: rgb(66, 139, 202);
         }
         /* DEMO ONLY - REMOVES UNWANTED MARGIN */
         .well .list-group {
         margin-bottom: 0px;
         }
      </style>
   </head>
   <body>
      <nav class="navbar navbar-default">
         <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="{!! route('web.index') !!}">Preguntas Eunacom</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav navbar-right">
                  <li>
                     <a href="{!! route('web.index') !!}">
                      Preguntas
                     </a>
                  </li>
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name}} <span class="caret"></span></a>
                     <ul class="dropdown-menu">
                        <li>
                           <a href="{!! url('/logout') !!}"
                              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           Salir
                           </a>
                           <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                              style="display: none;">
                              {{ csrf_field() }}
                           </form>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <!-- /.navbar-collapse -->
         </div>
         <!-- /.container-fluid -->
      </nav>
      <!-- Include the above in your HEAD tag -->
      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="col-xs-12 col-lg-8 col-lg-offset-2">
         <div class="box-header with-border no-print">
            <h3 class="box-title"><span class="text-success">Buenas</span> vs <span class="text-danger">Malas</span>
            </h3>
         </div>
         <div class="chart no-print">
            <!-- Sales Chart Canvas -->
            <canvas id="barChart" style="height: 180px" ;></canvas>
         </div>
      </div>
      <!-- Bootstrap core JavaScript
         ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="{{asset('js/counters.js')}}"></script>
      <script
         src="https://code.jquery.com/jquery-3.3.1.min.js"
         integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
         crossorigin="anonymous"></script>
      <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/Chart.js') }}"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script type="text/javascript">

        var salesChartData = {
            labels: [moment().subtract(6, 'days').format('dd'), moment().subtract(5, 'days').format('dd'), moment().subtract(4, 'days').format('dd'), moment().subtract(3, 'days').format('dd'), moment().subtract(2, 'days').format('dd'), moment().subtract(1, 'days').format('dd'), moment().subtract(0, 'days').format('dd')],
            datasets: [
                {
                    label: 'Buenas',
                    fillColor: 'rgb(60, 118, 61)',
                    strokeColor: 'rgb(60, 118, 61)',
                    pointColor: 'rgb(226, 18, 18)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgb(220,220,220)',
                    data: {!! json_encode($total_goods) !!}
                },
                {
                    label: 'Malas',
                    fillColor: 'rgb(169, 68, 66)',
                    strokeColor: 'rgb(169, 68, 66)',
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: {!! json_encode($total_bads) !!}
                }
            ]
        };
 
        var salesChartOptions = {
            // Boolean - If we should show the scale at all
            showScale: true,
            // Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: true,
            // String - Colour of the grid lines
            scaleGridLineColor: 'rgba(0,0,0,.05)',
            // Number - Width of the grid lines
            scaleGridLineWidth: 1,
            // Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            // Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            // Boolean - Whether the line is curved between points
            bezierCurve: true,
            // Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            // Boolean - Whether to show a dot for each point
            pointDot: true,
            // Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            // Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            // Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            // Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            // Boolean - Whether to fill the dataset with a color
            datasetFill: false,
            // String - A legend template
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            // Boolean - whether to make the chart responsive to window resizing
            responsive: true
        };

         //-------------
         var barChartCanvas = $('#barChart').get(0).getContext('2d')
         var barChart = new Chart(barChartCanvas)
         var barChartData = salesChartData
         
         barChart.Bar(barChartData, salesChartOptions)
         
      </script>
   </body>
</html>