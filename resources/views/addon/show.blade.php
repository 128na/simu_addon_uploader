@extends('template')

@section('content')
<div>
  <label for="title">タイトル</label>
  <span>{{ $model->title }}</span>
</div>
<div>
  <label for="description">説明</label>
  <span>{{ $model->description }}</span>
</div>
<div>
  <label>ファイル名</label>
  <span>{{ $model->name }}</span>
</div>
<div>
  <label>pakサイズ</label>
  <span>{{ $model->getPakList(',') }}</span>
</div>
<div>
  <label>ダウンロード</label>
  <span>{{ $model->counter->count }}回</span>
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

<form method="post" action="{{ route('addon.download', ['id' => $model->id]) }}">
  {{ csrf_field() }}
  <input type="submit" value="ダウンロード">
</form>
@endsection