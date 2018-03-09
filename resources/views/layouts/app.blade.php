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

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="{{ url('favicon.ico') }}">

</head>
<body>
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
              <li><a class="nav-link" href="{{ route('login') }}">ログイン</a></li>
              <li><a class="nav-link" href="{{ route('register') }}">登録</a></li>
            @else
            @if (Auth::user()->is_admin)
              <li><a class="nav-link" href="{{ route('admin.user') }}"><span class="text-danger">[Admin]</span>ユーザー</a></li>
              <li><a class="nav-link" href="{{ route('admin.addon') }}"><span class="text-danger">[Admin]</span>投稿</a></li>
            @endif

              <li><a class="nav-link" href="{{ route('addon.manage') }}">投稿一覧</a></li>
              <li><a class="nav-link" href="{{ route('user.index') }}">ユーザー情報</a></li>
              <li>
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  ログアウト
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
        <a href="https://github.com/128na/simu_addon_uploader" target="_blank">Github</a> Pull requests are always welcome!</span>
    </div>
  </nav>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
