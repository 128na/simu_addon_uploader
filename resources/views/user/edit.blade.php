@extends('layouts.app')

@section('title')
ユーザー情報
@endsection

@section('content')
<div class="container">

  <form method="post" action="{{ route('user.update') }}">
    {{ csrf_field() }}
    <dl>
      <dt><label for="name"><span class="badge badge-danger">必須</span> ユーザー名</label></dt>
      <dd><input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control"></dd>
      <dt><label for="email"><span class="badge badge-danger">必須</span> メールアドレス</label></dt>
      <dd><input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control"></dd>
    </dl>
    <input type="submit" class="btn btn-primary" value="更新する">
  </form>
</div>
@endsection