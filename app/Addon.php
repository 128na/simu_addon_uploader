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
}
