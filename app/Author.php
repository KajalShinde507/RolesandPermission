<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{   
    use SoftDeletes;
    protected $fillable=['authorname','email','author'];
    protected $dates=['deleted_at'];

    public function books()
    {
        return $this->belongsTo(Book::class,'author','id');
    }

  
    protected $hidden=['created_at','updated_at'];


    
    public function favouriteauthors() {

        return $this->belongsToMany(favouriteauthor::class);
            
     }





    protected $appends = ['is_fav','is_delete'];

    public function getIsFavAttribute(){
        //return true;
        $is_fav = 0;
        $button_text = 'Favourite';
        $query = favouriteauthor::where('author_id', $this->id)->where('user_id', Auth::user()->id)->exists();
        if($query){
            $is_fav = 1;
            $button_text = 'Unfavourite';
        }
    return ['is_fav' => $is_fav, 'txt' => $button_text];


    }


    public function getIsDeleteAttribute(){
        //return true;
        $is_delete=0;
        
       
        $button_text = 'recover';
        $query = Author::where('id', $this->id)->exists();
        if($query){
            $is_delete=1;
            $button_text = 'delete';
        }
    return ['is_delete' => $is_delete, 'txt' => $button_text];


    }

    
}
