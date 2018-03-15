<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ClubRelationshipResource extends Resource
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
            //'comments' => (new ArticleCommentsRelationshipResource($this->comments))->additional(['article' => $this]),
            'teams' => (new ClubTeamsRelationshipResource($this->teams))->additional(['club' => $this]),
            //'players' => 
        ];
        
    }
}
