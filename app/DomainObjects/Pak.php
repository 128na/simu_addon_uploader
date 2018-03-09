<?php

namespace App\DomainObjects;

use Illuminate\Database\Eloquent\Model;

class Pak extends Model
{
  protected $fillable = [
    'name',
  ];

  public function addons()
  {
    return $this->hasMany('App\DomainObjects\Addon');
  }

}
