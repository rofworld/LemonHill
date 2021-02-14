<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lemon Hill') }}</title>

    <!-- Scripts -->
    <!--
    <script src="{{ asset('js/app.js') }}" defer></script>
    -->


    <!-- Fonts -->
    <!--
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    -->
    <!-- Styles -->
    <!--
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  -->
  <script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
  <link href="{{ asset('css/components.css') }}" rel="stylesheet" media="screen">
  <link href="{{ asset('css/screen.css') }}" rel="stylesheet" media="screen">

  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main id="page-main">

        <nav id="site-nav" class="nav-smart">
          <div>
            <a class="site-logo" href="http://acozar.github.io/bcncss/" title="Barcelona CSS">
						<img src="{{ asset('images/descarga.jpg') }}" alt="BCN CSS">
					  </a>
            <input type="checkbox" id="mobnav" name="mobnav" aria-hidden="true" hidden="">
            <strong><label for="mobnav">Menú<mark></mark></label></strong>
            <div hidden="">
						<a href="index.html" title="BCNcss">BCNCSS</a>
						<a href="styles.html" title="Styles">Styles</a>
            @guest
                            @if (Route::has('login'))

                                    <a href="{{ route('login') }}">{{ __('Login') }}</a>

                            @endif

                            @if (Route::has('register'))

                                    <a href="{{ route('register') }}">{{ __('Register') }}</a>

                            @endif
            @else
              <div class="menu pull-right" >
              			<label for="navmenu-1" style="font-weight:normal;">{{ Auth::user()->name }}<mark></mark></label>
              			<input type="checkbox" id="navmenu-1" name="navmenu" hidden>
              			<label class="overlay-transparent" for="navmenu-1" hidden></label>
              			<nav hidden>
              				<ul>
              					<li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
              				</ul>
              			</nav>
		           </div>

            @endguest
            </div>
          </div>
        </nav>
<hr>
@yield('content')

</main>

</body>
</html>
