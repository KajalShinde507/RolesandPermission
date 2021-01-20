<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Collection;

class Book extends Model
{
    protected $fillable=['bookname','author','price'];

   

    public function authors()
    {
        return $this->hasone(Author::class,'id');
    }

   

    public function favouritebooks() {

        return $this->belongsToMany(favouritebook::class);
            
     }

   
    protected $dates = [
        'bookpublished_at',
    ];


    
    protected $hidden=['created_at','updated_at'];

    protected $appends = ['is_fav'];

    public function getIsFavAttribute(){
        return true;
    }

}
