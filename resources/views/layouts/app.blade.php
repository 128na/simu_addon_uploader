<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="canonical" href="{{ Request::url() }}">

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
@include('parts.header')
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

@include('parts.footer')
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
