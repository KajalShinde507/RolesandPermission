<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{   
    
    protected $fillable=['authorname','email'];


    public function books()
    {
        return $this->belognsTo(Book::class,'author','id');
    }
}
