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
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Basic Upload Statistics</div>
   
                <div class="card-body">
     Here you can see the date and time of your last upload, as well as the number of entries you've made.
<br>
<input type='button' value='Show Statistics' id='but_fetchall'>
<br>
     <table border='1' id='userTable' style='border-collapse: collapse;'>
       <thead>
        <tr>
          <th>Last Upload Made At:</th>
          <th>Number of Entries Thus Far:</th>
        </tr>
       </thead>
       <tbody></tbody>
     </table>
</div>
</div>
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
    </head>

     <script type='text/javascript'>
     $(document).ready(function(){

       // Fetch all records
       $('#but_fetchall').click(function(){
	 fetchRecords();
       });

     });

     function fetchRecords(){
       $.ajax({
         url: '/getData',
         type: 'get',
         dataType: 'json',
         success: function(response){

                 var created_at = response['dt'].created_at;
                 var num_of_entries = response['dt'].id;
                 var tr_str = "<tr>" +
                   "<td align='center'>" + created_at + "</td>" +
                   "<td align='center'>" + num_of_entries + "</td>" +
                 "</tr>";
                 
                 $("#userTable tbody").append(tr_str);
              }
       });

     }
     </script>
  </body>
</html>