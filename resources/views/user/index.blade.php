@extends('layouts.app')

@section('title')
ユーザー情報
@endsection

@section('content')
<div class="container">
  <dl>
    <dt>ユーザー名</dt>
    <dd>{{ $user->name }}</dd>
    <dt>メールアドレス</dt>
    <dd>{{ $user->email }}</dd>
    <dt>登録日</dt>
    <dd>{{ $user->created_at }}</dd>
  </dl>
  <a href="{{ route('user.edit') }}" class="btn btn-primary">編集する</a>
  <hr>
  <a href="{{ route('user.delete') }}" class="btn btn-danger">アカウントを削除する</a>
</div>
@endsection