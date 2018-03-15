<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;


class ClubResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);             // return default array

        return [
            'type' => 'club',
            'id' => (string)$this->id,
            'attributes' => [
                'name' => $this->name,
                'address1' => $this->address1,
                'address2' => $this->address2,
                'suburb' => $this->suburb,
                'postcode' => $this->postcode,
                'state' => $this->state,
                'country' => $this->country,
            ],
            //'relationships' => new ClubRelationshipResource($this),
            'relationships' => new ClubRelationshipResource($this),
            'links' => [
                'self' => route('api.club.show', ['club' => $this->id]),
            ],
            //'teams' => TeamsResource::collection($this->teams),    // include related resource (teams)
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

    }
}
