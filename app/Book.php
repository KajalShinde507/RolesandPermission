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
   /* public function authors()//oneauthor has many books
    {
       return $this->hasMany(Author::class,'id');
    }*/
    protected $dates = [
        'bookpublished_at',
    ];


    public function getBookNameAttribute($value)
    {
        return ucfirst($value);
    }
    public function setBookNameAttribute($value)
    {
        $this->attributes['bookname'] = strtolower($value);
    }
    protected $hidden=['created_at','updated_at'];

}
