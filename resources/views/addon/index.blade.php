@extends('template')

@section('content')
<form method="post" action="{{ route('addon.upload') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input type="file" name="upload_file" accept='application/zip'>
  <input type="submit">
</form>
<hr>

<ul>
@forelse ($models as $model)
  <li>
    <span><a href="{{ route('addon.show', ['id' => $model->id]) }}"><strong>{{ $model->title }}</strong></a></span>
    <span>By username</span>
    <span>{{ $model->getCount() }}回</span>
    <span>{{ $model->getPakList(',') }}</span>
    <span>{{ $model->created_at }}</span>
  </li>
@empty
  <li>なし</li>
@endforelse
@endsection
</ul>