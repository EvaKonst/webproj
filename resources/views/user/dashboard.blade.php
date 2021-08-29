@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            
            html, body {
                background-image: linear-gradient(rgba(255,255,255,0.5), rgba(255,255,255,0.5)), url('https://cedar-pro.com/wp-content/uploads/2017/07/data-analytics.png');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .Row: after {
                
                content: "";
                clear: both;
                display: table;
                width: 100px;
                height: 100px;
                -moz-background-clip: padding;
                -webkit-background-clip: padding;
                background-clip: padding-box;
    
            }
            .Column{
                
                display: table-cell;
                float: left;
                width: 33.33%;
                padding: 50px;
                margin: 10px;
                border: 3px solid #ffcba4;
                background-color: #ffcba4;
                opacity:0.7;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
                
            }
            .h1{
                color: #fff;  
            }
            .container {
                align-items: center;
                text-align: center;
                height: 100px;
            }
            .container:hover{
                opacity:0.3;
                
                align-items: center;
                height: 100px;
                
                
            }
            .links > a {
                color: #fff;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .hide {
                opacity:0;
            }   

            .myDIV:hover{
                display: block;
                opacity:1;
            }
            .hide:hover {
                display: block;
                opacity:1;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .button {
                background-color:#92a1cf
            }

        </style>
    </head>
<body>

 <!-- message triggered when password is successfully changed -->
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

        <div class="flex-center position-ref full-height">
           @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                      @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif 
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
                <script type="text/javascript"> 
                        document.getElementById('inputfile') 
                            .addEventListener('change', function() { 

                            const fr=new FileReader(); 
                            fr.onload=function(){       
                            var myfileobj = JSON.parse(fr.result);
                    //     console.log(myfileobj);

                            const entries = myfileobj.log.entries;
                            window.myobj = [];

                            for (x in entries) {
                                
                                let myarray = entries[x];
                                let url = myarray.request.url;
                                var new_url = url.replace('http://','').replace('https://','').split(/[/?#]/)[0];

                                myobj[x] = {
                            <!--      startedDateTime: myarray.startedDateTime,
                                    timings: myarray.timings,
                                    serverIPAddress: myarray.serverIPAddress,
                                    request_method: myarray.request.method,
                                    request_URL: new_url,
                                    response_status: myarray.response.status,
                                    response_status_Text: myarray.response.statusText
                                    };
                                    console.log(myobj[x]);
                                
                                for(y in myarray.request.headers){
                                    
                                    let headerName1 = myarray.request.headers[y].name;
                                    let headerValue1 = myarray.request.headers[y].value;

                                    if (headerName1 === "content-type")
                                    {
                                        myobj[x].Request_content_type = headerValue1;
                                    }
                                    else if (headerName1 === "host")
                                    {
                                        myobj[x].Request_host = headerValue1;
                                    }
                                    else if (headerName1 === "age")
                                    {
                                        myobj[x].Request_age = headerValue1;
                                    }
                                    else if (headerName1 === "expires")
                                    {
                                        myobj[x].Request_expires = headerValue1;
                                    }
                                    else if (headerName1 === "pragma")
                                    {
                                        myobj[x].Request_pragma = headerValue1;
                                    }
                                    else if (headerName1 === "cache-control")
                                    {
                                        myobj[x].Request_cache_control = headerValue1;
                                    }
                                    else if (headerName1 === "last-modified")
                                    {
                                        myobj[x].Request_last_modified = headerValue1;
                                    }
                                }
                                
                                for(y in myarray.response.headers){
                                    
                                    let headerName = myarray.response.headers[y].name;
                                    let headerValue = myarray.response.headers[y].value;

                                    if (headerName === "content-type")
                                    {
                                        myobj[x].Response_content_type = headerValue;
                                    }
                                    else if (headerName === "host")
                                    {
                                        myobj[x].Response_host = headerValue;
                                    }
                                    else if (headerName === "age")
                                    {
                                        myobj[x].Response_age = headerValue;
                                    }
                                    else if (headerName === "expires")
                                    {
                                        myobj[x].Response_expires = headerValue;
                                    }
                                    else if (headerName === "pragma")
                                    {
                                        myobj[x].Response_pragma = headerValue;
                                    }
                                    else if (headerName === "cache-control")
                                    {
                                        myobj[x].Response_cache_control = headerValue;
                                    }
                                    else if (headerName === "last-modified")
                                    {
                                        myobj[x].Response_last_modified = headerValue;
                                    }
                                }
                            }
                            };          
                        fr.readAsText(this.files[0]);
                        }) 
                </script>
        <br>

         <a id="exportJSON" onclick="exportJson(this);" class="btn"><button class="myDIV button"> Store data locally</a></button> 
         <script>
         function exportJson(el) {
                    var data = "text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(window.myobj));
                    // what to return in order to show download window?

                    el.setAttribute("href", "data:"+data);
                    el.setAttribute("download", "data.json");    
                    }
         </script>

            <button class="myDIV button" type="Upload Data" name="upload_har"> Upload data </button>
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

@endsection