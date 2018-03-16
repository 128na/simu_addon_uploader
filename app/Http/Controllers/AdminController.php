<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\DomainObjects\Addon;
use App\DomainObjects\User;

class AdminController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }


  public function user(Request $request)
  {
    $models = User::paginate(config('app.per_page'));
    return view('admin.user', compact('models'));
  }

  public function userDelete(Request $request, $id)
  {
    $model = User::findOrFail($id);

    try {
      $model->addons->each(function($addon) {
        unlink(static::getAddonPath($addon->path));
      });
    } catch(\Exception $e) {
      return static::errorReportAndRedirect($e, $request, __('messages.error.delete'), 'admin.user');
    }

    $model->delete();
    $request->session()->flash('success', __('messages.success.delete'));
    return redirect()->route('admin.user', ['lang' => \App::getLocale()]);
  }

  public function addon(Request $request)
  {
    $models = Addon::with(['user', 'paks', 'counter'])
      ->paginate(config('app.per_page'));
    return view('admin.addon', compact('models'));
  }

  public function addonDelete(Request $request, $id)
  {
    $model = Addon::findOrFail($id);

    try {
      unlink(static::getAddonPath($model->path));
    } catch(\Exception $e) {
      return static::errorReportAndRedirect($e, $request, __('messages.error.delete'), 'admin.addon');
    }
    $model->delete();
    $request->session()->flash('success', __('messages.success.delete'));
    return redirect()->route('admin.addon', ['lang' => \App::getLocale()]);
  }
}
