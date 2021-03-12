<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Collection;
use Auth;
class Book extends Model
{

    use SoftDeletes;
    protected $fillable=['bookname','author','price'];
     protected $dates=['deleted_at'];
   

    public function authors()
    {
        return $this->hasone(Author::class,'id');
    }

   

    public function favouritebooks() {

        return $this->belongsToMany(favouritebook::class);
            
     }

   
   
        

    
    protected $hidden=['created_at','updated_at'];

    protected $appends = ['is_fav','is_delete'];

    public function getIsFavAttribute(){
        //return true;
        $is_fav = 0;
        $button_text = 'Favourite';
        $query = favouritebook::where('book_id', $this->id)->where('user_id', Auth::user()->id)->exists();
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
        $query = Book::where('id', $this->id)->exists();
        if($query){
            $is_delete=1;
            $button_text = 'delete';
        }
    return ['is_delete' => $is_delete, 'txt' => $button_text];


    }

}
