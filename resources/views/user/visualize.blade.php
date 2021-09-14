<!doctype html>
<html>
   <body>
   <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    HTTP Traffic Data Analysis System 
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div id="mapid">

  <!-- <div class="backdrop">
    <div class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div> -->

  <div class="alert alert-light alert-dismissible fade show" role="alert">
    You can see at the map below the IP locations of all HTTP requests.
    <input type='button' value='Show Information' id='getarequest'>
  </div>

</div>
 </div>
    <head>
     <!-- Script -->
     <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --> <!-- jQuery CDN -->
     <script src="{{asset('js/app.js')}}" ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <?php 
    $includes = array('<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>',
    ' <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>',
    '<script src="../plugins/heatmaps.js"></script>',
    '<script src="../plugins/leaflet-heatmap.js"></script>');
    ?>
    </head>

     <script type='text/javascript'>
     $(document).ready(function(){

       // Fetch all records
       $('#getarequest').click(function(){
	 fetchmap();
       });

     });

     function fetchmap(){
       $.ajax({
         url: '/gettheData',
         type: 'get',
         dataType: 'json',
         success: function(outputs){
            for(i=0; i<outputs['mydt']; i++)
            {
                 var serverIPaddress = outputs['mydt'][i];
                 var cities;
                 $.getJSON('https://freegeoip.app/json/', function(data){
                 cities[i] = data.city;
                });
                }
            }
      
       //console.log(registered_users);
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
        });  
    });  

     }
     </script>
  </body>
</html>