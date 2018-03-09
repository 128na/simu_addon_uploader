<?php

namespace App\DomainObjects;

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

  public function scopeUser($query, $user)
  {
    return $query->where('user_id', $user->id);
  }

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
