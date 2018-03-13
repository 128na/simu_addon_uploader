@extends('layouts.app')

@section('title')
{{ __('messages.page.addon.input') }}
@endsection

@section('content')
<div class="container">
  <form method="post" action="{{ route('addon.regist', ['lang' => \App::getLocale()]) }}">
    {{ csrf_field() }}
    <div class="form-group">
      <label>{{ __('messages.addon.filename') }}</label>
      <p>{{ $model->name }}</p>
    </div>

    <div class="form-group">
      <label for="title"><span class="badge badge-danger">{{ __('messages.label.required') }}</span> {{ __('messages.addon.title') }}</label>
      <input type="text" name="title" id="title" value="{{ old('title', $model->title) }}" class="form-control">
    </div>
    <div class="form-group">
      <label for="description"><span class="badge badge-info">{{ __('messages.label.optional') }}</span> {{ __('messages.addon.description') }}</label>
      <textarea name="description" id="description" class="form-control">{{ old('description', $model->description) }}</textarea>
    </div>
    <div class="form-group">
      <label><span class="badge badge-info">{{ __('messages.label.optional') }}</span> {{ __('messages.addon.paks') }}</label><br>
@foreach ($paks as $pak)
      <div class="form-check form-check-inline">
        <label class="form-check-label">
        <input
          type="checkbox"
          name="paks[]"
          value="{{ $pak->id }}"
          class="form-check-input"
@if (in_array($pak->id, old('paks', [])))
          checked
@endif
      >
          {{ $pak->name }}
        </label>
      </div>
@endforeach
    </div>

    <div>
      <label>{{ __('messages.addon.list') }}</label>
@include('parts.addon-list', ['items' => $model->info])
    </div>
    <hr>
    <div class="form-group">
      <input type="submit" class="btn btn-primary" value="{{ __('messages.action.register') }}">
      <hr>
      <input type="submit" value="{{ __('messages.action.cancel') }}" class="btn btn-danger btn_confirm" data-message="{{ __('messages.label.confirm_cancel_input') }}" formaction="{{ route('addon.cancel', ['lang' => \App::getLocale()]) }}">
    </div>
  </form>
</div>
@endsection
