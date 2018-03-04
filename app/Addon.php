<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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

  public function scopeStatus($query, $status)
  {
    return $query->where('status', $status);
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }
  public function counter()
  {
    return $this->hasOne('App\Counter');
  }
  public function paks()
  {
    return $this->belongsToMany('App\Pak');
  }

  public function getCount()
  {
    return $this->counter->count;
  }
  public function getPakList($delimiter = ', ')
  {
    $pak_list = $this->paks->map(function($pak) {
      return $pak->name;
    })->toArray();
    return implode($delimiter, $pak_list);
  }
}
