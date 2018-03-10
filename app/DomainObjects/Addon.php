<?php

namespace App\DomainObjects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Status;

class Addon extends Model
{
  protected $fillable = [
    'user_id',
    'title',
    'name',
    'path',
    'description',
    'info',
    'status',
  ];

  protected $casts = [
    'info' => 'array',
  ];

  public function user()
  {
    return $this->belongsTo('App\DomainObjects\User');
  }
  public function counter()
  {
    return $this->hasOne('App\DomainObjects\Counter');
  }
  public function paks()
  {
    return $this->belongsToMany('App\DomainObjects\Pak');
  }

  public function scopeStatus($query, $status)
  {
    return $query->where('status', $status);
  }

  public function scopeUser($query, $user)
  {
    return $query->where('user_id', $user->id);
  }

  public function getCount()
  {
    return $this->counter->count ?? -1;
  }
  public function getPakList($delimiter = ', ')
  {
    $pak_list = $this->paks->map(function($pak) {
      return $pak->name;
    })->toArray();
    return implode($delimiter, $pak_list);
  }

  /**
   * DBインスタンスをモデルに変換するのがめどいのでID一覧を取得してからモデルを取得し直す
   */
  public static function freeWord($word)
  {
    $wild_word = "%{$word}%";
    $ids = DB::table('addons')
      ->select('addons.id')
      ->join('users', 'users.id', '=', 'addons.user_id')
      ->join('addon_pak', 'addon_pak.addon_id', '=', 'addons.id', 'left outer')
      ->join('paks', 'paks.id', '=', 'addon_pak.pak_id', 'left outer')
      ->orWhere('addons.title', 'like', $wild_word)
      ->orWhere('addons.name', 'like', $wild_word)
      ->orWhere('addons.description', 'like', $wild_word)
      ->orWhere('addons.info', 'like', $wild_word)
      ->orWhere('users.name', 'like', $wild_word)
      ->orWhere('paks.name', 'like', $wild_word)
      ->distinct()
      ->get()
      ->map(function($item) {return $item->id;})
      ->toArray();

    return static::whereIn('id', $ids);
  }
}
