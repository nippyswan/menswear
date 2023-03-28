<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar sticky-top navbar-expand-md navbar-light navbar-laravel" id="hid">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/menswear/public/png/logo.jpg"  height="30">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                         @auth
                         <li class="nav-item">
                            <a class="nav-link" href="/menswear/public/expense">Expenses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/menswear/public/sellshare">Sell to Shareholder</a>
                        </li>
                          <li class="nav-item">
                            <a class="nav-link" href="/menswear/public/closure">Day Closure</a>
                        </li>
                       
                       @if((Auth::user()->username)==="admin")
                            <li class="nav-item dropdown">
                                <a id="item" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Items <span class="caret"></span>
                                </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="item">
                                    <a class="dropdown-item" href="/menswear/public/instock">
                                        In Stock
                                    </a>
                                    <a class="dropdown-item" href="/menswear/public/additem">
                                        Purchase Item
                                    </a>
                                    <a class="dropdown-item" href="/menswear/public/retbycust">
                                        Sales Return 
                                    </a>
                                    <a class="dropdown-item" href="/menswear/public/rettowhole">
                                        Purchase Return 
                                    </a>
                                    <a class="dropdown-item" href="/menswear/public/lost">
                                        Damaged Or Lost Entry
                                    </a>
                                    
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                                <a id="reports" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                 Reports    <span class="caret"></span>
                                </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="reports">
                                    <a class="dropdown-item" href="/menswear/public/profit">
                                        Profit
                                    </a>
                                    <a class="dropdown-item" href="/menswear/public/purchase">
                                        Purchase
                                    </a>
                                    <a class="dropdown-item" href="/menswear/public/purchaseret">
                                        Purchase Return
                                    </a>
                                    <a class="dropdown-item" href="/menswear/public/salesrep">
                                        Sales
                                    </a>
                                    <a class="dropdown-item" href="/menswear/public/salesretrep">
                                        Sales Return
                                    </a>
                                    <a class="dropdown-item" href="/menswear/public/exp">
                                       Expenses 
                                    </a>
                                    <a class="dropdown-item" href="/menswear/public/lostdam">
                                       Damaged/Lost 
                                    </a>
                            </div>
                        </li>
                        
                            <li class="nav-item dropdown">
                                <a id="users" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                 Users   <span class="caret"></span>
                                </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="users">
                                    <a class="dropdown-item" href="/menswear/public/listdeluser">
                                        Show
                                    </a>
                                    <a class="dropdown-item" href="{{ route('register') }}">
                                        Add
                                    </a>
                                    
                            </div>
                        </li>
                        
                       @endif       
                       @endauth

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <!--<li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                           @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif   -->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} 
                                    <span class="caret"></span>
                                
                                    
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/menswear/public/changepassword">
                                        Change Password
                                    </a>
                                    <a class="dropdown-item" href="/menswear/public/changeemail">
                                        Change Email<p style="font-size:10px;">{{ Auth::user()->email }}</p>
                                    </a>
                                    @if((Auth::user()->username)==="admin")
                                    <a class="dropdown-item" href="/menswear/public/backup">
                                        Backup Data
                                    </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <div>
        <!--<nav class="navbar sticky-bottom navbar-expand-md navbar-light  navbar-laravel" style="background-color: #e3f2fd;" id="hidb">-->
            <footer style="background-color: #e3f2fd;" id="hidb">
           
                <div class="col-md-12" style="font-size:12px;" align="center">
                Copyright &copy; <?php echo date("Y");?> Swan Innovation., Belbari
                <br>Contact: nippyanoj@gmail.com
                </div>

           </footer>
        <!--</nav>-->
    </div>
</body>
</html>
