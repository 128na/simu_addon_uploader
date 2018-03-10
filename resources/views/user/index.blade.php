@extends('layouts.app')

@section('title')
{{ __('messages.page.user.index') }}
@endsection

@section('content')
<div class="container">
  <dl>
    <dt>{{ __('messages.user.name') }}</dt>
    <dd>{{ $user->name }}</dd>
    <dt>{{ __('messages.user.email') }}</dt>
    <dd>{{ $user->email }}</dd>
    <dt>{{ __('messages.user.created_at') }}</dt>
    <dd>{{ $user->created_at }}</dd>
  </dl>
  <a href="{{ route('user.edit') }}" class="btn btn-primary">{{ __('messages.action.edit') }}</a>
  <hr>
  <a href="{{ route('user.delete') }}" class="btn btn-danger btn_confirm" data-message="{{ __('messages.label.confirm_delete_user') }}">{{ __('messages.action.delete_user') }}</a>
</div>
@endsection
