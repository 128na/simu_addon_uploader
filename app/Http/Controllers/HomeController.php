<?php

namespace App\Http\Controllers;

use App\DomainObjects\Addon;
use App\DomainObjects\Pak;
use App\Models\Status;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
  public function __construct()
  {
    parent::__construct('addon', Addon::class);
  }

  public function index(Request $request)
  {
    $models = $this
      ->model_name::status(Status::PUBLISH)
      ->with(['user', 'paks', 'counter'])
      ->paginate(config('app.per_page'));
    return view("{$this->view_dir}.index", compact('models'));
  }

  public function show(Request $request, $id)
  {
    $id = $request->route('id');
    $model = $this
      ->model_name::status(Status::PUBLISH)
      ->with(['user', 'paks', 'counter'])
      ->findOrFail($id);
    return view("{$this->view_dir}.show", compact('model'));
  }

  public function download(Request $request, $id)
  {
    $id = $request->route('id');
    $model = $this->model_name::status(Status::PUBLISH)
      ->with(['counter'])
      ->findOrFail($id);

    $counter = $model->counter;
    $counter->count++;
    $counter->save();

    $path = static::getAddonPath($model->path);
    return response()->download($path, $model->name);
  }

  public function search(Request $request)
  {
    $word = $request->input('word');
    $models = Addon::freeWord($word)
      ->status(Status::PUBLISH)
      ->with(['user', 'paks', 'counter'])
      ->paginate(config('app.per_page'));

    return view("{$this->view_dir}.search", compact('word', 'models'));
  }
}
