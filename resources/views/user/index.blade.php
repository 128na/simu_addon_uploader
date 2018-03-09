@extends('layouts.app')

@section('title')
{{ __('messages.page.user') }}
@endsection

@section('content')
<div class="container">
  <dl>
    <dt>{{ __('messages.name') }}</dt>
    <dd>{{ $user->name }}</dd>
    <dt>{{ __('messages.email') }}</dt>
    <dd>{{ $user->email }}</dd>
    <dt>{{ __('messages.created_at') }}</dt>
    <dd>{{ $user->created_at }}</dd>
  </dl>
  <a href="{{ route('user.edit') }}" class="btn btn-primary">{{ __('messages.edit') }}</a>
  <hr>
  <a href="{{ route('user.delete') }}" class="btn btn-danger">{{ __('messages.delete_user') }}</a>
</div>
@endsection
