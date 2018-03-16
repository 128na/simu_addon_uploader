@auth
  <h2>{{ __('messages.action.upload') }}</h2>
  @if(session()->has('addon_id'))
  <div class="card mb-4">
    <div class="card-body">
      <strong>{{ __('messages.label.has_incomplete') }}</strong>
      <form method="post" action="{{ route('addon.cancel', ['lang' => \App::getLocale()]) }}">
        {{ csrf_field() }}
        <a href="{{ route('addon.input', ['lang' => \App::getLocale()]) }}" class="btn btn-primary">{{ __('messages.page.addon.input') }}</a>
        <input type="submit" value="{{ __('messages.action.cancel') }}" class="btn btn-danger btn_confirm" data-message="{{ __('messages.label.confirm_cancel_input') }}">
      </form>
    </div>
  </div>
  @else
  <form method="post" action="{{ route('addon.upload', ['lang' => \App::getLocale()]) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="MAX_FILE_SIZE" value="{{ config('app.file_size_limit_mb', 10) * (1024**2) }}">
    <div class="input-group mb-4">
      <input type="file" name="upload_file" accept="application/zip" class="form-control">
      <div class="input-group-append">
        <input type="submit" class="btn btn-primary" value="{{ __('messages.action.upload') }}" class="form-control">
      </div>
    </div>
  </form>
  @endif
@endauth
