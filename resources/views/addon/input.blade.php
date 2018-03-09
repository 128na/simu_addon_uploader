@extends('layouts.app')

@section('title')
{{ __('messages.page.input') }}
@endsection

@section('content')
<div class="container">
  <form method="post" action="{{ route('addon.regist') }}">
    {{ csrf_field() }}
    <div class="form-group">
      <label>{{ __('messages.filename') }}</label>
      <p>{{ $model->name }}</p>
    </div>

    <div class="form-group">
      <label for="title"><span class="badge badge-danger">{{ __('messages.required') }}</span> {{ __('messages.title') }}</label>
      <input type="text" name="title" id="title" value="{{ old('title', $model->title) }}" class="form-control">
    </div>
    <div class="form-group">
      <label for="description"><span class="badge badge-info">{{ __('messages.optional') }}</span> {{ __('messages.description') }}</label>
      <textarea name="description" id="description" class="form-control">{{ old('description', $model->description) }}</textarea>
    </div>
    <div class="form-group">
      <label><span class="badge badge-info">{{ __('messages.optional') }}</span> {{ __('messages.paks') }}</label><br>
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
      <label>{{ __('messages.addons') }}</label>
@include('parts.addon-list', ['items' => $model->info])
    </div>
    <hr>
    <div class="form-group">
      <input type="submit" class="btn btn-primary" value="{{ __('messages.register') }}">
        <input type="submit" value="{{ __('messages.cancel') }}" class="btn btn-danger" formaction="{{ route('addon.cancel') }}">
    </div>
  </form>
</div>
@endsection
