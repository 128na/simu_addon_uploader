@extends('template')

@section('content')
<form method="post" action="{{ route('addon.upload') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input type="file" name="upload_file">
  <input type="submit">
</form>
<hr>

<ul>
@forelse ($models as $model)
  <li>
    <a href="{{ route('addon.show', ['id' => $model->id]) }}">{{ $model->name }}</a>
    <strong>{{ $model->title }}</strong>
    <small>{{ $model->description }}</small></li>
@empty
  <li>なし</li>
@endforelse
@endsection
</ul>