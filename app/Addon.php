<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
  protected $fillable = [
    'user_id',
    'name',
    'path',
    'description',
    'info',
    'status',
  ];

  protected $casts = [
    'info' => 'array',
  ];
}
