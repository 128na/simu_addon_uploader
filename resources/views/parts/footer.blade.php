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