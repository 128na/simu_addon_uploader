<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Addon;
use App\Status;

use \Zipper;

class AddonController extends Controller
{
  public function __construct()
  {
    parent::__construct('addon', Addon::class);
  }

  public function upload(Request $request)
  {
    // todo:validate request

    $upload_file = $request->file('upload_file');
    try {
      $path = $upload_file->store('addons');
    } catch(\Exception $e) {
      dd('失敗した'.$e->getMessage());
    }

    // todo:dat抽出処理
    $info = $this->extract_dat_info($path);
    // todo:readme抽出処理?

    $model = Addon::create([
      'user_id'     => 123,
      'name'        => $upload_file->getClientOriginalName(),
      'path'        => $path,
      'status'      => Status::DRAFT,
      'description' => '',
      'info'        => [],
    ]);

    return view("addon.upload", compact('model'));
  }

  public function input(Request $request)
  {

  }

  private function extract_dat_info($path)
  {
    $file_path = str_replace('/', DIRECTORY_SEPARATOR, storage_path($path));

    dump($file_path);
    $zipper = Zipper::make($file_path);
    dump($zipper);
    $dat_files = $zipper->listFiles(); 

    dd($dat_files);
  }
}
