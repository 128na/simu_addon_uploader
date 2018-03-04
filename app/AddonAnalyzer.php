<?php

namespace App;

class AddonAnalyzer
{
  private $zipper;

  public function __construct($path)
  {
    $this->zipper = \Zipper::make($path);
  }

  public function extractDatFiles()
  {
    return $this->zipper->listFiles('/\.dat$/i'); 
  }

  public function extractObjInfo($path)
  {
    $content = $this->zipper->getFileContent($path);
    // 区切り文字を--に統一
    $content = preg_replace('/\-{3,}/', '--', $content);

    $dats = explode('--', $content);

    $result = [];
    foreach ($dats as $dat) {

      // nameプロパティがないものはスキップ
      if (stripos($dat, 'name') === false) {
        continue;
      }

      $reg = '/name=(.*)/';
      preg_match($reg, $dat, $name);
      $reg = '/copyright=(.*)/';
      preg_match($reg, $dat, $copyright);

      $data = [
        'name' => $name[1] ?? '',
        'copyright' => $copyright[1] ?? '',
      ];
      $result[] = $data;
    }
    return $result;
  }


  public function extractTabFiles()
  {
    return $this->zipper->listFiles('/\.tab$/i'); 
  }

  public function extractTabInfo($path)
  {
    $content = $this->zipper->getFileContent($path);

    $tabs = explode("\n", $content);
    $tabs = array_map('trim', $tabs);
    $tabs = array_filter($tabs, function($tab) {
      return trim($tab) && stripos(trim($tab), '#') === false;
    });

    $tabset = [];
    do {
     $name = current($tabs);
      next($tabs);
      $label = current($tabs);
      $tabset[$name] = $label;
    }
    while (next($tabs) !== false);

    return $tabset;
  }
}
