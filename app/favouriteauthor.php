<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class favouriteauthor extends Model
{
    protected $fillable=['user_id','author_id'];
    public $timestamps = false;

    protected $hidden=['created_at','updated_at'];
    

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function authors(){
        return $this->belongsTo(Author::class,'is_fav','author_id');
    }


   /* protected $appends = ['is_fav'];

    public function getIsFavAttribute(){
        //return true;
        return 1;
    }*/
}
