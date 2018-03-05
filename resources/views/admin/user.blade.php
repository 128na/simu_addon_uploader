@extends('layouts.app')

@section('title')
ユーザー管理
@endsection

@section('content')
<div class="container">
@include('parts.upload')
  <h2>ユーザー管理</h2>
  <ul class="content-list">
    <li class="content-title">
      <div class="row">
        <div class="col-sm-8">ユーザー名</div>
        <div class="col-sm-2">権限</div>
        <div class="col-sm-2">操作</div>
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
          <span class="badge badge-primary">管理者</span>
@else
          <span class="badge badge-secondary">投稿者</span>
@endif
        </div>
        <div class="col-sm-2">
          <a href="{{ route('admin.user.delete', ['id' => $model->id]) }}" class="btn btn-danger btn-sm">削除</a>
        </div>
      </div>
    </li>
@empty
    <li class="content-item">
      投稿がありません
    </li>
@endforelse
  </ul>

  {{ $models->links() }}
</div>
@endsection