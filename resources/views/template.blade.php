<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('title') | アドオンアップローダー（仮）</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <h1>アドオンアップローダー（仮）</h1>
@if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
@endif
      <hr>
@section('sidebar')
@show

@yield('content')
    </div>
  </body>
</html>