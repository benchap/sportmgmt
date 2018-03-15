<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ClubTeamsRelationshipResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // additional passed in on creation of the resource object
        $club = $this->additional['club'];

        return [
            'data'  => TeamIdentifierResource::collection($this->collection),
            //'links' => [
            //    'self'    => route('articles.relationships.comments', ['article' => $article->id]),
            //    'related' => route('articles.comments', ['article' => $article->id]),
            ];
    }
}
