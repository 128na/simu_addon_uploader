<?php

namespace App\Models;

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
    return $this->belongsTo('App\Models\Addon');
  }
}
