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
        <div class="col-sm-8">{{ __('messages.name') }}</div>
        <div class="col-sm-2">{{ __('messages.permission') }}</div>
        <div class="col-sm-2">{{ __('messages.action') }}</div>
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
          <span class="badge badge-primary">{{ __('messages.admin') }}</span>
@else
          <span class="badge badge-secondary">{{ __('messages.guest') }}</span>
@endif
        </div>
        <div class="col-sm-2">
          <a href="{{ route('admin.user.delete', ['id' => $model->id]) }}" class="btn btn-danger btn-sm">{{ __('messages.delete') }}</a>
        </div>
      </div>
    </li>
@empty
    <li class="content-item">
      {{ __('messages.no_addons') }}
s    </li>
@endforelse
  </ul>

  {{ $models->links() }}
</div>
@endsection
