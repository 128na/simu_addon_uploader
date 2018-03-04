input page

<form method="post" action="{{ route('addon.input') }}">
  {{ csrf_field() }}
  <input type="text" name="name" value="{{ $model->name }}">

  <textarea name="description">{{ $model->description }}</textarea>


  <input type="submit">
</form>
