@auth
  <h2>{{ __('messages.upload') }}</h2>
  @if(session()->has('addon_id'))
  <div class="card mb-4">
    <div class="card-body">
      <strong>{{ __('messages.has_incomplete') }}</strong>
      <form method="post" action="{{ route('addon.cancel') }}">
        {{ csrf_field() }}
        <a href="{{ route('addon.input') }}" class="btn btn-primary">{{ __('messages.input') }}</a>
        <input type="submit" value="{{ __('messages.cancel') }}" class="btn btn-danger">
      </form>
    </div>
  </div>
  @else
  <form method="post" action="{{ route('addon.upload') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="MAX_FILE_SIZE" value="{{ config('app.file_size_limit_mb', 10) * (1024**2) }}">
    <div class="input-group mb-4">
      <input type="file" name="upload_file" accept="application/zip" class="form-control">
      <div class="input-group-append">
        <input type="submit" class="btn btn-primary" value="{{ __('messages.upload') }}" class="form-control">
      </div>
    </div>
  </form>
  @endif
@endauth
