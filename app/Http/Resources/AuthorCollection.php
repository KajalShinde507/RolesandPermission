<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AuthorCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'data' => $this->collection,
            'meta' => ['author_count' => $this->collection->count()],
            'links' => [
                'self' => 'https://laravel.com/docs/6.x/eloquent-resources',
            ],
            
            //'Author' => AuthorResource::collection($this->whenLoaded('authors')),
        ];
    }
}
