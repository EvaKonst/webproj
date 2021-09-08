<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
           @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    @if (Auth::user()->role=='user')
                        <a href="{{ url('/user_dashboard') }}">User Home</a> 
                    @endif
                    @if (Auth::user()->role=='admin')
                        <a href="{{ url('/admin_dashboard') }}">Admin Home</a> 
                    @endif
                    @else
                        <a href="{{ route('login') }}">Login</a>

                      @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif 

            <div class="content">
                <div class="title m-b-md", style="color:white;">
                    Http Traffic Data Analysis System
                </div>

                <div class="links">
                
                    <a href="https://github.com/EvaKonst/webproj">GitHub</a>
                </div>
            </div>
        </div>


    </body>
</html>
