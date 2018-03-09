@extends('layouts.app')

@section('title')
{{ __('messages.page.top') }}
@endsection

@section('og-description')
{{ config('app.description') }}@endsection

@section('content')
<div class="container">
@include('parts.upload')
  <h2>{{ __('messages.addons') }}</h2>
  <ul class="content-list">
    <li class="content-title">
      <div class="row">
        <div class="col-sm-5">{{ __('messages.filename') }}</div>
        <div class="col-sm-2">{{ __('messages.author') }}</div>
        <div class="col-sm-2">{{ __('messages.paksize') }}</div>
        <div class="col-sm-1">{{ __('messages.dl_count') }}</div>
        <div class="col-sm-2">{{ __('messages.posted_at') }}</div>
      </div>
    </li>
@forelse ($models as $model)
    <li class="content-item">
      <div class="row">
        <div class="col-sm-5 break">
          <a href="{{ route('addon.show', ['id' => $model->id]) }}">
            <strong>{{ $model->title }}</strong>
          </a>
        </div>
        <div class="col-sm-2">
          {{ $model->user->name }}
        </div>
        <div class="col-sm-2">
          @include('parts.paksize-list', ['items' => $model->paks])
        </div>
        <div class="col-sm-1">
          {{ $model->getCount() }}
        </div>
        <div class="col-sm-2">
          {{ $model->created_at }}
        </div>
      </div>
    </li>
@empty
    <li class="content-item">
      {{ __('messages.no_addons') }}
    </li>
@endforelse
  </ul>

  {{ $models->links() }}
</div>
@endsection
