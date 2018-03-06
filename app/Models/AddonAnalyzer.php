<?php

namespace App\Models;

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

    $content = static::prepareDat($content);

    $dats = explode('--', $content);

    $result = [];
    foreach ($dats as $dat) {

      // nameプロパティがないものはスキップ
      if (stripos($dat, 'name') === false) {
        continue;
      }

      $reg = '/name=(.*)/i';
      preg_match($reg, $dat, $name);
      $reg = '/copyright=(.*)/i';
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

  public function close()
  {
    return $this->zipper->close();
  }

  private static function prepareDat($content)
  {
    // 区切り文字を--に統一
    $content = preg_replace('/\-{3,}/', '--', $content);
    // 改行コードを統一
    $content = str_replace(["\r\n","\r","\n"], "\n", $content);

    return $content;
  }
}
