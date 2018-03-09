@extends('layouts.app')

@section('og-description')
{{ $model->description }}@endsection

@section('title')
{{ $model->title }}@endsection

@section('content')
<div class="container">
  <h1 class="break">{{ $model->title }}</h1>
  <div class="card mb-4">
    <div class="card-body">
      <h3 class="card-title">{{ $model->name }}</h3>
      <h6 class="card-subtitle mb-2 text-muted"><span class="text-pre">{{ $model->description }}</span></h6>
      <p class="card-text">
        <div>{{ __('messages.paksize') }}:
          @include('parts.paksize-list', ['items' => $model->paks])
        </div>
        <div>{{ __('messages.download') }}: {{ $model->counter->count }}</div>
      </p>

      <form method="post" action="{{ route('addon.download', ['id' => $model->id]) }}">
        {{ csrf_field() }}
        <input type="submit" value="{{ __('messages.download') }}" class="btn btn-primary">
      </form>
    </div>
    <div class="card-footer">
      <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-hashtags="simutrans" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>
  </div>
  <div>
    @include('parts.addon-list', ['items' => $model->info])
  </div>
</div>
@endsection
