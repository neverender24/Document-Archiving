<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>USEP CRMS</title>
    <!--<title>{{ config('app.name', 'USEP_CRMS') }}</title>-->
    <!-- Styles -->

 <style>
            html, body {
               
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
                 background-color: #9a0000;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
                 background-color: #323332;

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
                
                width: 220vh;
           
           
             float: left;
            
           
              height: 90vh;
            }

            .title {
                font-size: 50px;
                text-align: right;
                 padding: 0 25px;
            }

            .links > a {
                color: #323332;
                padding: 0 25px;
                font-size: 15px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .t-b-md {
                margin-bottom: -65px;
            }


        </style>


    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vendors.css') }}" rel="stylesheet">
</head>


<body>

        <div>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <b><a class="navbar-brand" href="{{ url('#') }}">
                     <!--   {{ config('app.name', 'USEP_CRMS') }} -->
                     <p style="color:white">USEP CENTRALIZE RECORD MANAGEMENT SYSYTEM</p>
                    </a></b>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav ">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->

                          @if (Route::has('login'))
               
                    @auth
                        <li><a href="{{ url('/home') }}">Home</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                    @endauth
             
            @endif


                        
                    </ul>
                </div>
               
            </div>
        </nav>

        
         <div class ="sulods">

          </div>
        

    
    

</body>
</html>
