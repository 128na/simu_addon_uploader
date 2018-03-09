@extends('layouts.app')

@section('title')
{{ __('messages.page.edit') }}
@endsection

@section('content')
<div class="container">

  <form method="post" action="{{ route('user.update') }}">
    {{ csrf_field() }}
    <dl>
      <dt><label for="name"><span class="badge badge-danger">{{ __('messages.required') }}</span> {{ __('messages.name') }}</label></dt>
      <dd><input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control"></dd>
      <dt><label for="email"><span class="badge badge-danger">{{ __('messages.required') }}</span> {{ __('messages.email') }}</label></dt>
      <dd><input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control"></dd>
    </dl>
    <input type="submit" class="btn btn-primary" value="{{ __('messages.update') }}">
  </form>
</div>
@endsection
