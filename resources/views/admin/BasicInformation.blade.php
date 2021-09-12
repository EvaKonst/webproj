
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
                <div class="card-header">Basic Information</div>
   
                <div class="card-body">
     Here you can see the number of registered users as well as the number of unique providers and domains.
<br>
<input type='button' value='Show Information' id='getrequest'>

</div>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
      <table border='1' id='adminTable' style='border-collapse: collapse;'>
       <thead>
        <tr>
          <th>Last Upload Made At:</th>
          <th>Number of Entries Thus Far:</th>
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
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
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
       $('#getrequest').click(function(){
        //console.log(registered_users);
        fetchInformation();
        //console.log(registered_users);     
     });
    });

     function fetchInformation(){
       $.ajax({
         url: '/getInfo',
         type: 'get',
         dataType: 'json',
         success: function(outputs){

                 var registered_users = outputs['mydt'].reg_users;

                 var number_unique_domains = outputs['mydt'].unique_domains_num;
                 var number_unique_provider = outputs['mydt'].unique_provider_num;
                 var tr_str = "<tr>" +
                   "<td align='center'>" + registered_users + "</td>" +
                   "<td align='center'>" + number_unique_domains + "</td>" +
                   "<td align='center'>" + number_unique_provider + "</td>" +
                 "</tr>";
                 
                 $("#adminTable tbody").append(tr_str);
              }
       });
       //console.log(registered_users);
       $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
  }
});  
      
     }
     </script>
  </body>
</html>