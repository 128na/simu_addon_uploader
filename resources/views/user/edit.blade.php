@extends('layouts.app')

@section('title')
{{ __('messages.page.user.edit') }}
@endsection

@section('content')
<div class="container">

  <form method="post" action="{{ route('user.update', ['lang' => \App::getLocale()]) }}">
    {{ csrf_field() }}
    <dl>
      <dt><label for="name"><span class="badge badge-danger">{{ __('messages.label.required') }}</span> {{ __('messages.user.name') }}</label></dt>
      <dd><input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control"></dd>
      <dt><label for="email"><span class="badge badge-danger">{{ __('messages.label.required') }}</span> {{ __('messages.user.email') }}</label></dt>
      <dd><input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control"></dd>
    </dl>
    <input type="submit" class="btn btn-primary" value="{{ __('messages.action.update') }}">
  </form>
</div>
@endsection
