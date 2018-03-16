<form method="get" action="{{ route('addon.search', ['lang' => \App::getLocale()]) }}">
  <div class="input-group">
    <input type="text" class="form-control" name="word" placeholder="{{ __('messages.label.keyword') }}" value="{{ $word ?? '' }}">
    <div class="input-group-append">
      <input type="submit" class="btn btn-outline-primary" value="{{ __('messages.action.search') }}">
    </div>
  </div>
</form>
