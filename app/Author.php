<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{   
    
    protected $fillable=['authorname','email','author'];


    public function books()
    {
        return $this->belongsTo(Book::class,'author','id');
    }

  
    protected $hidden=['created_at','updated_at'];
}
