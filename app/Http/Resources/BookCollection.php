<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Auth;
class BookCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
       return [
        'data' => $this->collection->toArray(),
        'meta' => ['book_count' => $this->collection->count()],
        'links' => [
            'self' => 'https://laravel.com/docs/6.x/eloquent-resources',
            'sort' => $this->collection->sortBy('price'),
              
        ],
       
        //'Author' => AuthorResource::collection($this->whenLoaded('authors')),
    ];
    }
    public function with($request)
    {
        return [
            'meta' => [
                'key' => 'value',
            ],
        ];
    }
}
