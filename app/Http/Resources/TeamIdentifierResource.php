<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TeamIdentifierResource extends Resource
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
            'type' => 'teams',
            'id' => (string)$this->id,
            'name' => $this->name,
        ];
    }
}
