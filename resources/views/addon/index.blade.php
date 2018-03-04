index page

<form method="post" action="{{ route('addon.upload') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input type="file" name="upload_file">
  <input type="submit">
</form>

@forelse ($models as $model)
    <li>{{ $model->name }}</li>
@empty
    <p>なし</p>
@endforelse