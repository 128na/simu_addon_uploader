<div class="card">
  <div class="card-body">
    <h3 class="card-title">{{ __('messages.addon.list') }}</h3>
  </div>
  <ul class="list-group list-group-flush">
@foreach ($items as $item)
    <li class="list-group-item">
      <div><strong>{{ $item['name'] }}</strong>（{{ $item['copyright'] }}）</div>
      <div>tabfile: {{ implode(', ', $item['tabs']) }}</div>
    </li>
@endforeach
  </ul>
</div>


