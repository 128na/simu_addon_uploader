<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DomainObjects\Addon;
use App\Models\Status;
use App\Http\Resources\AddonCollection;
use App\Http\Resources\AddonResource;
use Illuminate\Support\Facades\DB;

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
    $word = "%{$word}%";
    $ids = DB::table('addons')
      ->select('addons.id')
      ->join('users', 'users.id', '=', 'addons.user_id')
      ->join('addon_pak', 'addon_pak.addon_id', '=', 'addons.id')
      ->join('paks', 'paks.id', '=', 'addon_pak.pak_id')
      ->orWhere('addons.title', 'like', $word)
      ->orWhere('addons.name', 'like', $word)
      ->orWhere('addons.description', 'like', $word)
      ->orWhere('addons.info', 'like', $word)
      ->orWhere('users.name', 'like', $word)
      ->orWhere('paks.name', 'like', $word)
      ->distinct()
      ->get()
      ->map(function($item) {return $item->id;})
      ->toArray();

    $models = Addon::status(Status::PUBLISH)
      ->with(['user', 'paks', 'counter'])
      ->whereIn('id', $ids)
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
