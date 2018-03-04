<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
  protected $fillable = [
    'addon_id',
    'count',
  ];

  protected $casts = [
    'count' => 'integer',
  ];

  public function addon()
  {
    return $this->belongsTo('App\Addon');
  }
}
