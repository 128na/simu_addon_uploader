<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $model_name;
    protected $view_dir;

    public function __construct($view_dir = '', $model_name = '') {
        $this->view_dir = $view_dir;
        $this->model_name = $model_name;
    }

    public function index(Request $request)
    {
      $models = $this->model_name::all();
      return view("{$this->view_dir}.index", compact('models'));
    }


    public function show(Request $request, $id)
    {
      $model = $this->model_name::findOrFail($id);

      return view("{$this->view_dir}.show", compact('model'));
    }


  protected static function errorReportAndRedirect($e, $request, $message, $dest = 'idnex')
  {
    logger()->error($e->getMessage());
    $request->session()->flash('error', $message);
    return redirect()->route($dest, ['lang' => \App::getLocale()]);
  }


  // storage/app/addons/xxx.zip
  protected static function getAddonPath($path)
  {
    return realpath(storage_path("app/{$path}"));
  }


  public function redirectTo() {
    return route('addon.manage', ['lang' => \App::getLocale()]);
  }
}
