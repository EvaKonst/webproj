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

  

  <div class="alert alert-light alert-dismissible fade show" role="alert">
    You can see at the map below the IP locations of all HTTP requests.
    <br>
    <div>   
          <div id="geo"></div>
       <?= $lava->render('GeoChart', 'Users', 'pop-div') ?>
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
    
    <meta charset="utf-8">
    </head>
    
  
      
     <script type='text/javascript'>
     $(document).ready(function(){

      
       $('#getarequest').click(function(){
	 fetchmap();
       });

     });

     function fetchmap(){
       $.ajax({
         url: '/gettheData',
         type: 'get',
         dataType: 'json',
         success: function(){
           
           
      }
    });  

     }
     </script>
  </body>
</html>