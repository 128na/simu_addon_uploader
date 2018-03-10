<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DomainObjects\Addon;
use App\Models\Status;
use App\Http\Resources\AddonCollection;
use App\Http\Resources\AddonResource;

class V1Controller extends Controller
{
  public function index(Request $request)
  {
    $models = Addon::status(Status::PUBLISH)
      ->with(['user', 'paks', 'counter'])
      ->paginate(20);

    return new AddonCollection($models);
  }
  public function search(Request $request)
  {
    $word = $request->input('word');
    $models = Addon::freeWord($word)
      ->status(Status::PUBLISH)
      ->with(['user', 'paks', 'counter'])
      ->paginate(20);

    return new AddonCollection($models);
  }
  public function show(Request $request, $id)
  {
    $model = Addon::status(Status::PUBLISH)
      ->with(['user', 'paks', 'counter'])
      ->findOrFail($id);

    return new AddonResource($model);
  }

}
