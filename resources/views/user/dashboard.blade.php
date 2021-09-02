<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title> 

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/user/har_edit.js') }}" defer></script> 
        <script src="{{asset('js/app.js')}}" ></script>

        <!-- Styles -->
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    </head>

<body>
 <!-- message triggered when password is successfully changed -->
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <ul class="navbar-nav ml-auto">
           @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                                    </form>
                                </div>
                    @endauth
                </div>
            @endif 
    </ul>       
        <div class="Row" style= "display:flex; justify-content:space-between; hover{opacity:0.2;}">

            
            <div class="Column">
            <div class="container">
                <div class= "myDIV">
                    <h1 class="content" style="color: #000;">Upload Data</h1>
                </div>
            </div>
                <div class="Row" style= "display:flex; justify-content:space-between;">

                <input type="file" name="inputfile" id="inputfile" accept=".har"> 
                <pre id="output"></pre> 

                <a id="exportJSON" onclick="exportJson(this);" class="btn"><button class="myDIV button"> Store data locally</a></button> 

                <button id="uploadJSON" class="myDIV button" type="Upload Data"> Upload data </button>
                </div>
                </div>
                
                <div class="Column">
                <div class="container">
                    <h1 class="content" style="color: #000;">Visualize Data</h1>
                </div>
                </div>
                
                <div class="Column">
                <div class="container">
                    <h1 class="content" style="color: #000;"><a href="{{ route('change.password') }}">Edit Profile Information</a></h1>
                </div>
                </div>
                    
            </div>
    </body>
</html>

