<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable=['bookname','author','price'];
    public function authors()
    {
        return $this->hasone(Author::class,'id');
    }

}