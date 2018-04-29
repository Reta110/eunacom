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
      <link rel="stylesheet" href="{{asset('css/styles.css')}}">
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
                     <a href="{!! route('web.stadistics') !!}">
                      Estadísticas
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
         <h3 class="text-center">{{$question->code.'.-'.$question->title}}</h3>
         <div class="well" style="overflow: auto;">
            <div id="myform">
               @foreach(json_decode($question->options, true) as $key => $value)
               <div class="form-group has-feedback">
                  <label class="input-group">
                     <span class="input-group-addon">
                     <input type="radio" data-value='{{ $value['option'] }}'  data-code="{{$question->code}}" class="list-group-item {{ $value['option'] }}" name="test" value="0" />
                     </span>
                     <div class="form-control form-control-static input">
                        {{ $value['name'] }} 
                     </div>
                     <span class="glyphicon form-control-feedback "  id='{{ $value['option'] }}'></span>
                  </label>
               </div>
               @endforeach
               <br>
               <br>
               <p>
                  <button class="btn btn-primary col-xs-12" id="get-checked-data">Revisar</button>
                  <a class="btn btn-success col-xs-12" href="{{route('web.index')}}"  id='next' style="display: none">Siguiente</a>
               </p>
               <pre id="display-json"></pre>
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-lg-8 col-lg-offset-2 text-center">
        <div class='row'>
           <div class="counter col-xs-6">
              <h4>Totales</h4>
              <div class="counter col-xs-6">
                <i class="fa fa-code fa-2x"></i>
                <h2 class="timer count-title count-number" id='goods' data-to="{{$goods}}" data-speed="1"></h2>
                <p class="count-text text-success">Buenas</p>
             </div>
             <div class="counter col-xs-6">
                <i class="fa fa-coffee fa-2x"></i>
                <h2 class="timer count-title count-number" id='bads' data-to="{{$bads}}" data-speed="1"></h2>
                <p class="count-text text-danger">Malas</p>
             </div>
           </div>
           <div class="counter col-xs-6" style="border-left: 1px solid #eeeeee ">
              <h4>De hoy</h4>
              <div class="counter col-xs-6">
                
                <i class="fa fa-code fa-2x"></i>
                <h2 class="timer count-title count-number" id='today_goods' data-to="{{$today_goods}}" data-speed="1"></h2>
                <p class="count-text text-success">Buenas</p>
             </div>
             <div class="counter col-xs-6">
                <i class="fa fa-coffee fa-2x"></i>
                <h2 class="timer count-title count-number" id='today_bads' data-to="{{$today_bads}}" data-speed="1"></h2>
                <p class="count-text text-danger">Malas</p>
             </div>
           </div>
         </div>
         <div class='row'>
           <div class="counter col-xs-6">
            <div class="progress">
              <div class="progress-bar progress-bar-success" role="progressbar" style="width:{{$totals_goods_percent}}%">
                {{$totals_goods_percent}}%
              </div>
              <div class="progress-bar progress-bar-danger" role="progressbar" style="width:{{$totals_bads_percent}}%">
                {{$totals_bads_percent}}%
              </div>
            </div>
           </div>
            <div class="counter col-xs-6">
              <div class="progress-bar progress-bar-success" role="progressbar" style="width:{{$today_goods_percent}}%">
                {{$today_goods_percent}}%
              </div>
              <div class="progress-bar progress-bar-danger" role="progressbar" style="width:{{$today_bads_percent}}%">
                {{$today_bads_percent}}%
              </div>
           </div>
         </div>
          <div class='row'>
           <div class="counter col-xs-12">
              Creado por @Reta110
           </div>
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
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script type="text/javascript">
         $(function(){
             $('.a').attr('checked', 'checked');
         });
         
         $('#get-checked-data').on('click', function(event) {
             event.preventDefault(); 
         
             $('#display-json').html('');
             $('#get-checked-data').css('display','none');
             $('#next').show();
         
             var answer = $("#myform input[type='radio']:checked").attr('data-value');
         //Check response
         var token = $('meta[name="csrf-token"]').attr('content');
         $.ajax({
         url: "{{route('check.answer')}}",
         method: 'POST',
         data: {
             _token: token,
             code: $("#myform input[type='radio']:checked").attr('data-code'),
             answer: answer
         },
         success: function (data) {
         
             $('#display-json').html(data.status+' La respuesta es la: '+data.correct);
         
             $("input[type='radio']").attr('disabled', 'disabled');
         
             if(answer == data.correct){
                 $('#'+data.correct).addClass('glyphicon-ok');
                 $('#'+data.correct).css('color','green');
                 $('#goods').html(parseInt($('#goods').html()) + 1);
                 $('#today_goods').html(parseInt($('#today_goods').html()) + 1);
         
             }else{
                 $('#'+answer).addClass('glyphicon-remove');
                 $('#'+answer).css('color','red');
                 $('#'+data.correct).addClass('glyphicon-ok');
                 $('#'+data.correct).css('color','green');
                 $('#bads').html(parseInt($('#bads').html()) + 1);
                 $('#today_bads').html(parseInt($('#today_bads').html()) + 1);
             }
         
             $('#next').removeAttr('disabled');
         }
         });
         
         //$('#displayjson').html(JSON.stringify(checkedItems, null, '\t'));
         });
         
      </script>
   </body>
</html>