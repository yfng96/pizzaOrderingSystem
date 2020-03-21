<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>JomPixxa</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body style="background-color:#eeeeee">
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" style="margin-bottom:0px;top:0;width:100%;position:fixed;background-color:#84bab7">
            <div class="container">
                <div class="navbar-header">

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}" style="font-variant: small-caps; color:black">
                        JomPixxa
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="{{ route('user.pizza.cart') }}" style="color:black">
                                Order Cart
                                <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
                            </a>
                        </li>
                        <!-- Authentication Links -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" style="color:black" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('user.pizza.profile') }}">
                                            History
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('user.pizza.change_password') }}">
                                            Change Password
                                        </a>
                                    </li>
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
                    </ul>
                </div>
            </div>
        </nav>
        <div style="margin-top:50px">
            @yield('content')
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
