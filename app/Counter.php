<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
  protected $fillable = [
    'addon_id',
    'count',
  ];
}
