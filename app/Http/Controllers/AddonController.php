<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

use App\Exceptions\DatNotFoundException;

use App\DomainObjects\Addon;
use App\DomainObjects\Pak;
use App\DomainObjects\Counter;
use App\Models\Status;
use App\Models\AddonAnalyzer;

use \Exception;
use \Zipper;

class AddonController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    parent::__construct('addon', Addon::class);
  }

  public function upload(Request $request)
  {
    $request->validate([
      'upload_file' => 'required|file|mimetypes:application/zip',
    ]);
    $upload_file = $request->file('upload_file');

    try {
      $path = $upload_file->store('addons');
    } catch(Exception $e) {
      return static::errorReportAndRedirect($e, $request, __('messages.error.file_store_failed'), 'addon.manage');
    }

    // dat抽出
    try {
      $info = static::getInfo($path);
    } catch(DatNotFoundException $e) {
      return static::errorReportAndRedirect($e, $request, __('messages.error.dat_not_found'), 'addon.manage');
    } catch(Exception $e) {
      return static::errorReportAndRedirect($e, $request, __('messages.error.file_analyze_failed'), 'addon.manage');
    }

    // todo:readme抽出処理?

    $model = $this->model_name::create([
      'user_id'     => Auth::id(),
      'name'        => $upload_file->getClientOriginalName(),
      'title'       => $upload_file->getClientOriginalName(),
      'path'        => $path,
      'status'      => Status::DRAFT,
      'description' => '',
      'info'        => $info,
    ]);
    $request->session()->put('addon_id', $model->id);

    return redirect()->route('addon.input');
  }

  public function input(Request $request)
  {
    $id = $request->session()->get('addon_id');

    if (is_null($id)) {
      $request->session()->flash('error', __('messages.error.file_not_found'));
      return redirect()->route('addon.manage');
    }
    $model = $this->model_name::findOrFail($id);
    $paks = Pak::all();

    return view('addon.input', compact('model', 'paks'));
  }


  public function regist(Request $request)
  {
    $request->validate([
      'title'       => 'required|string|max:255',
      'description' => 'nullable|string',
      'paks'        => 'array',
      'paks.*'      => 'exists:paks,id',
    ]);

    $id = $request->session()->get('addon_id');

    try {
      $model = $this->model_name::findOrFail($id);
    } catch(ModelNotFoundException $e) {
      return static::errorReportAndRedirect($e, $request, __('messages.error.post_not_found'), 'addon.manage');
    }

    $model->fill([
      'title'       => $request->input('title'),
      'description' => $request->input('description'),
      'status'      => Status::PUBLISH,
    ])->save();

    $paks = [];
    foreach ($request->input('paks', []) as $pak_id) {
      $paks[] = Pak::findOrFail($pak_id);
    }
    $model->paks()->saveMany($paks);

    Counter::create([
      'addon_id' => $model->id,
      'count'    => 0,
    ]);

    $request->session()->forget('addon_id');
    $request->session()->flash('success', __('messages.success.publish'));
    return redirect()->route('addon.index');
  }


  public function cancel(Request $request)
  {
    $id = $request->session()->get('addon_id');

    try {
      $model = $this->model_name::findOrFail($id);
    } catch(ModelNotFoundException $e) {
      return static::errorReportAndRedirect($e, $request, __('messages.error.file_not_found'), 'addon.manage');
    }
    try {
      unlink(static::getAddonPath($model->path));
    } catch(\Exception $e) {
      return static::errorReportAndRedirect($e, $request, __('messages.error.file_delete_failed'), 'addon.manage');
    }
    $model->delete();

    $request->session()->forget('addon_id');
    $request->session()->flash('success', __('messages.success.cancel'));
    return redirect()->route('addon.manage');
  }

  public function manage(Request $request)
  {
    $models = $this
      ->model_name::status(Status::PUBLISH)
      ->user(Auth::user())
      ->with(['paks', 'counter'])
      ->paginate(50);
    return view("{$this->view_dir}.manage", compact('models'));
  }

  public function delete(Request $request, $id)
  {
    $model = $this
      ->model_name::status(Status::PUBLISH)
      ->user(Auth::user())
      ->findOrFail($id);

    try {
      unlink(static::getAddonPath($model->path));
    } catch(\Exception $e) {
      return static::errorReportAndRedirect($e, $request, __('messages.error.file_delete_failed'), 'addon.manage');
    }
    $model->delete();
    $request->session()->flash('success', __('messages.success.delete'));
    return redirect()->route('addon.manage');
  }

  // ファイル名の情報（*.dat, *.tab）を取得する
  private static function getInfo($path)
  {
    $path = static::getAddonPath($path);

    $analyzer = new AddonAnalyzer($path);

    $dats = [];
    $tabs_list = [];
    foreach ($analyzer->extractDatFiles() as $file) {
      $dats = array_merge($dats, $analyzer->extractObjInfo($file));
    }

    if (count($dats) < 1) {
      $analyzer->close();
      unlink($path);
      throw new DatNotFoundException();
    }

    foreach ($analyzer->extractTabFiles() as $file) {
      $tabs_list[static::getFilename($file)] = $analyzer->extractTabInfo($file);
    }
    // *.tabとobj名を関連付ける
    $dats = static::associateTab($dats, $tabs_list);

    return $dats;
  }

  // ファイル名を取得する
  private static function getFilename($path)
  {
    return basename($path);
  }

  // dat情報にtab情報をマージする
  private static function associateTab($dats, $tabs_list)
  {
    return array_map(function($dat) use($tabs_list) {
      $dat['tabs'] = static::findTab($dat['name'], $tabs_list);
      return $dat;
    }, $dats);
  }

  // obj名に一致する翻訳一覧を取得する
  private static function findTab($name, $tabs_list)
  {
    $result = [];
    foreach ($tabs_list as $list_name => $tabs) {
      if(array_key_exists($name, $tabs)) {
        $result[$list_name] = $tabs[$name];
      }
    }
    return $result;
  }
}
