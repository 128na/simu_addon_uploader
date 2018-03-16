@extends('layouts.app')

@section('title')
{{ __('messages.page.admin.user') }}
@endsection

@section('content')
<div class="container">
@include('parts.upload')
  <h2>{{ __('messages.page.admin.user') }}</h2>
  <ul class="content-list">
    <li class="content-title">
      <div class="row">
        <div class="col-sm-8">{{ __('messages.user.name') }}</div>
        <div class="col-sm-2">{{ __('messages.user.permission') }}</div>
        <div class="col-sm-2">{{ __('messages.label.action') }}</div>
      </div>
    </li>
@forelse  ($models as $model)
    <li class="content-item">
      <div class="row">
        <div class="col-sm-8">
          <strong>{{ $model->name }}</strong>
        </div>
        <div class="col-sm-2">
@if($model->is_admin)
          <span class="badge badge-primary">{{ __('messages.user.admin') }}</span>
@else
          <span class="badge badge-secondary">{{ __('messages.user.guest') }}</span>
@endif
        </div>
        <div class="col-sm-2">
          <a href="{{ route('admin.user.delete', ['lang' => \App::getLocale(), 'id' => $model->id]) }}" class="btn btn-danger btn-sm btn_confirm" data-message="{{ __('messages.label.confirm_delete_item') }}">{{ __('messages.action.delete') }}</a>
        </div>
      </div>
    </li>
@empty
    <li class="content-item">
      {{ __('messages.label.no_item') }}
s    </li>
@endforelse
  </ul>

  {{ $models->links() }}
</div>
@endsection
