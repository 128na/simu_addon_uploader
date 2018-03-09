<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:title" content="@yield('title') | {{ config('app.name') }}">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:description" content="@yield('og-description')">
  <meta property="og:site_name" content="{{ config('app.name') }}">
  <meta name="twitter:card" content="summary">
  <meta name="description" content="@yield('og-description')">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') | {{ config('app.name') }}</title>

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-WRGT7PH');</script>
  <!-- End Google Tag Manager -->

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="{{ url('favicon.ico') }}">

</head>
<body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WRGT7PH"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">

          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
              <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.login')}}</a></li>
              <li><a class="nav-link" href="{{ route('register') }}">{{ __('messages.register')}}</a></li>
            @else
            @if (Auth::user()->is_admin)
              <li><a class="nav-link" href="{{ route('admin.user') }}"><span class="text-danger">[{{ __('messages.admin')}}]</span>{{ __('messages.users')}}</a></li>
              <li><a class="nav-link" href="{{ route('admin.addon') }}"><span class="text-danger">[{{ __('messages.admin')}}]</span>{{ __('messages.addons')}}</a></li>
            @endif

              <li><a class="nav-link" href="{{ route('addon.manage') }}">{{ __('messages.users')}}</a></li>
              <li><a class="nav-link" href="{{ route('user.index') }}">{{ __('messages.profile')}}</a></li>
              <li>
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  {{ __('messages.logout')}}
                </a>
              </li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <main class="py-4">
@if (session('success'))
      <div class="container alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
      <div class="container alert alert-danger">{{ session('error') }}</div>
@endif
@if ($errors->any())
      <div class="container alert alert-danger">
        <ul>
@foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
@endforeach
        </ul>
      </div>
@endif

      @yield('content')
    </main>
  </div>

  <nav class="navbar fixed-bottom navbar-light navbar-laravel border-top">
    <div class="container">
      <span>
        {{ config('app.name') }} <small>(version {{ config('app.version')}})</small> created by <a href="https://twitter.com/128Na" target="_blank">@128Na</a>.
         /
        <a href="https://github.com/128na/simu_addon_uploader" target="_blank">Github</a> Pull requests are always welcome!
      </span>
      <span class="pull-right">
@foreach(config('app.laguages') as $lang => $label)
        <a href="#" class="js_set_lang" data-lang="{{ $lang }}">{{ $label }}</a>
@endforeach
      </span>
    </div>
  </nav>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script>
    $(function(){
      const $js_set_lang = $('.js_set_lang')

      const set_lang = function(e) {
        e.preventDefault();
        const lang = e.target.dataset.lang;
        Cookies.set('lang', lang);
        location.reload();
      }

      $js_set_lang.on('click', set_lang)
    })
  </script>
</body>
</html>
