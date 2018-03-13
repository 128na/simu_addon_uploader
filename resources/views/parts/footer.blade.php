<nav class="navbar fixed-bottom navbar-light navbar-laravel border-top">
  <div class="container">
    <span>
      created by <a href="https://twitter.com/128Na" target="_blank">@128Na</a>.
       /
      <a href="https://github.com/128na/simu_addon_uploader" target="_blank">Github</a>
    </span>
    <span class="pull-right">
@foreach(config('app.languages') as $lang => $label)
<?php
  $name = \Request::route()->getName();
  $parameters = \Request::route()->parameters;
  $parameters['lang'] = $lang;
?>
      <a href="{{ route($name, $parameters) }}">{{ $label }}</a>
@endforeach
    </span>
  </div>
</nav>
