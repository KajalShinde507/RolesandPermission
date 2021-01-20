<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class favouritebook extends Model
{

    protected $fillable=['user_id','book_id'];
    public $timestamps = false;

    protected $hidden=['created_at','updated_at'];
    

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }
}