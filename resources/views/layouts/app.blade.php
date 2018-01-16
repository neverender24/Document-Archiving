<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/vendors.css') }}" rel="stylesheet">
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
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav ">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else

                        
                            <li><a href="{{ url('document') }}">Documents</a></li>
                            <li><a href="{{ url('inbox') }}">Inbox <span id="noti" class="badge badge-danger hidden"></span></a></li>
                            @role(['admin','level 0'])
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    <span class="fa fa-gear"></span> Settings <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    @role('admin')
                                    <li><a href="{{ url('college') }}"> Colleges</a></li>
                                    <li><a href="{{ url('department') }}"> Departments</a></li>
                                    <li><a href="{{ url('office') }}"> Offices</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ url('category') }}"> Document Categories</a></li>
                                    @endrole
                                    <li><a href="{{ url('drawer') }}"> Document Drawers</a></li>
                                </ul>
                            </li>
                            @endrole


                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
    
                                <ul class="dropdown-menu">
                                    @role(['admin','level 0'])
                                    <li><a href="{{ url('/register') }}"> Register User</a></li>
                                    @endrole

                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="col-md-8 col-md-offset-2">
            @if(Session::has('success'))
                <div class="alert alert-success"><em> {!! session('success') !!}</em></div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('footer_scripts')
    
    <script>
        $.get('/noti', function(data) {
            if(data != 0){
                $('#noti').removeClass('hidden');
                $('#noti').text(data);
            }else{
                $('#noti').text('0');
                $('#noti').addClass('hidden');
            }
        });
    </script>
    
    <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
    </script>

</body>
</html>
