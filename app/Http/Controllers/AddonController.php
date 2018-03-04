<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Addon;
use App\Pak;
use App\Counter;
use App\Status;
use App\AddonAnalyzer;

use \Exception;
use \Zipper;

class AddonController extends Controller
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
      ->get();
    return view("{$this->view_dir}.index", compact('models'));
  }

  public function show(Request $request, $id)
  {
    $model = $this
      ->model_name::status(Status::PUBLISH)
      ->with(['user', 'paks', 'counter'])
      ->findOrFail($id);
    return view("{$this->view_dir}.show", compact('model'));
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
      logger()->error($e->getTraceAsString());
      $request->session()->flash('error', 'アップロード失敗： ファイルを保存できませんでした');
      return redirect()->route('addon.index');
    }

    // dat抽出
    try {
      $info = static::getInfo($path);
    } catch(Exception $e) {
      logger()->error($e->getTraceAsString());
      $request->session()->flash('error', 'ファイル解析失敗');
      return redirect()->route('addon.index');
    }

    // todo:readme抽出処理?

    $model = $this->model_name::create([
      'user_id'     => 0,
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
      $request->session()->flash('error', 'ファイルがありません');
      return redirect()->route('addon.index');
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
      logger()->error($e->getTraceAsString());
      $request->session()->flash('error', 'ファイルが見つかりません');
      return redirect()->route('addon.index');
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
    $request->session()->flash('success', 'published.');
    return redirect()->route('addon.index');
  }

  public function download(Request $request, $id)
  {
    $model = $this->model_name::status(Status::PUBLISH)
      ->with(['counter'])
      ->findOrFail($id);

    $counter = $model->counter;
    $counter->count++;
    $counter->save();

    $path = static::getAddonPath($model->path);
    return response()->download($path, $model->name);

  }

    // storage/app/addons/xxx.zip
  private static function getAddonPath($path)
  {
    return realpath(storage_path("app/{$path}"));
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
      throw new Exception('dat files not found.');
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
