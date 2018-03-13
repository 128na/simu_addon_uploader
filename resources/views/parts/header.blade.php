<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      {{ config('app.name') }} <small>ver {{ config('app.version')}}</small>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <li>
          @include('parts.search-form')
        </li>
        <!-- Authentication Links -->
        @guest
          <li><a class="nav-link" href="{{ route('login', ['lang' => \App::getLocale()]) }}">{{ __('messages.action.login')}}</a></li>
          <li><a class="nav-link" href="{{ route('register', ['lang' => \App::getLocale()]) }}">{{ __('messages.action.register')}}</a></li>
        @else
        @if (Auth::user()->is_admin)
          <li><a class="nav-link" href="{{ route('admin.user', ['lang' => \App::getLocale()]) }}"><span class="text-danger">[{{ __('messages.user.admin')}}]</span>{{ __('messages.user.list')}}</a></li>
          <li><a class="nav-link" href="{{ route('admin.addon', ['lang' => \App::getLocale()]) }}"><span class="text-danger">[{{ __('messages.user.admin')}}]</span>{{ __('messages.addon.list')}}</a></li>
        @endif

          <li><a class="nav-link" href="{{ route('addon.manage', ['lang' => \App::getLocale()]) }}">{{ __('messages.addon.list')}}</a></li>
          <li><a class="nav-link" href="{{ route('user.index', ['lang' => \App::getLocale()]) }}">{{ __('messages.label.profile')}}</a></li>
          <li>
            <a class="nav-link" href="{{ route('logout', ['lang' => \App::getLocale()]) }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              {{ __('messages.action.logout')}}
            </a>
          </li>
          <form id="logout-form" action="{{ route('logout', ['lang' => \App::getLocale()]) }}" method="POST" style="display: none;">
            @csrf
          </form>
        @endguest
      </ul>
    </div>
  </div>
</nav>
