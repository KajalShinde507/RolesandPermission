<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    

    protected $fillable = [
        'user_id','token',
    ];
    
    protected $dates = ['created_at'];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function getDateFormat()
    {
     return 'Y-m-d H:i:s';
   }
}
