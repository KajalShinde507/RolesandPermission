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

    /*public function books1()//oneauthor has many books
    {
       return $this->hasMany(Book::class,'author','id');
    }*/
    protected $hidden=['created_at','updated_at'];
}
