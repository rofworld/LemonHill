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

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Yesteryear&display=swap" rel="stylesheet">
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
          <input type="checkbox" id="mobnav" name="mobnav" aria-hidden="true" hidden="">
          <strong><label for="mobnav"><span class="symbol-list"></span><mark></mark></label></strong>
          <div hidden="">
					<a class="site-logo" href="http://acozar.github.io/bcncss/" title="Lemon Hill">
						<img src="/images/descarga.jpg" alt="Lemon Hill Logo" class="image-logo"><b>Lemon Hill</b>
					</a>
          <a href="{{ url('/artist_info')}}" title="Artist Info" style="margin-left:150px;">Artist Info</a>
          <a href="{{ url('/events_info')}}" title="Events Info">Events Info</a>
          <a href="{{ url('/onlineShop')}}" title="Online Shop">Online Shop</a>
          @guest



                @if (Route::has('login'))

                <a href="{{ route('login') }}">{{ __('Login') }}</a>

                @endif

                @if (Route::has('register'))

                <a href="{{ route('register') }}">{{ __('Register') }}</a>

                @endif

            @else
                <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                                                   <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>

          @endguest



				 </div>
       </div>
			</nav>
      <hr>
      @if (Auth::check() && Auth::user()->admin==true)
      <nav id="page-nav" class="nav-scroll">
      <div>
        <a href="/product_list_admin" title="Product List">Product List</a>
        <a href="/product_creation_form" title="Create Product">Create Product</a>
        <a href="/artist_info_admin" title="Create Artist">Create Artist</a>
        <a href="/list_orders" title="Orders">Orders</a>
        <a href="/create_event" title="Orders">Create Event</a>
       </div>
       </nav>
       <hr>
       @endif
@yield('content')

</main>

</body>
</html>
