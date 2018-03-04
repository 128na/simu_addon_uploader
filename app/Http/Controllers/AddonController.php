<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Addon;
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

    $model = Addon::create([
      'user_id'     => 0,
      'name'        => $upload_file->getClientOriginalName(),
      'title'       => $upload_file->getClientOriginalName(),
      'path'        => $path,
      'status'      => Status::DRAFT,
      'description' => '',
      'info'        => $info,
    ]);
    $request->session()->put('addon_id', $model->id);

    return view('addon.upload', compact('model'));
  }

  public function input(Request $request)
  {
    $request->validate([
      'title'       => 'required|string|max:255',
      'description' => 'required|string',
    ]);

    $id = $request->session()->get('addon_id');

    try {
      $model = Addon::findOrFail($id);
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

    $request->session()->flash('success', 'published.');
    return redirect()->route('addon.index');
  }






  // ファイル名の情報（*.dat, *.tab）を取得する
  private static function getInfo($path)
  {
    // storage/app/addons/xxx.zip
    $path = realpath(storage_path("app/{$path}"));

    $analyzer = new AddonAnalyzer($path);

    $dats = [];
    $tabs_list = [];
    foreach ($analyzer->extractDatFiles() as $file) {
      $dats = array_merge($dats, $analyzer->extractObjInfo($file));
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
