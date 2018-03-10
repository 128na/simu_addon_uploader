<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id'          => $this->id,
          'title'       => $this->title,
          'name'        => $this->name,
          'description' => $this->description,
          'info'        => $this->info,
          'user'        => $this->user->name,
          'paks'        => $this->paks->map(function($pak) {return $pak->name;})->toArray(),
          'count'       => $this->counter->count,
          'created_at'  => $this->created_at,
        ];
    }
}
