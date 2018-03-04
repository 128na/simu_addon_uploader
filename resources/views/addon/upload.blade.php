@extends('template')

@section('content')
<form method="post" action="{{ route('addon.input') }}">
  {{ csrf_field() }}
  <div>
    <label for="title">タイトル</label>
    <input type="text" name="title" id="title" value="{{ $model->title }}">
  </div>
  <div>
    <label for="description">説明</label>
    <textarea name="description" id="description">{{ $model->description }}</textarea>
  </div>
  <div>
    <label>ファイル名</label>
    <span>{{ $model->name }}</span>
  </div>
  <div>
    <label>アドオン一覧</label>
    <ul>
@forelse ($model->info as $info)
      <li>
        <span><strong>{{ $info['name'] }}</strong>（{{ $info['copyright'] }}）</span>
        <small>tabfile: {{ implode(', ', $info['tabs']) }}</small>
      </li>
@empty
      <li>ないです</li>
@endforelse
    </ul>
  </div>

  <input type="submit">
</form>
@endsection