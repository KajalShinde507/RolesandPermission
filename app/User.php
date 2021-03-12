<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    //use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password' ,'role','gender','user_status','profile_picture','dob',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
     

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


   
     
     public function roles(){
        return $this->hasOne(Role::class,'id','role');
        //return $this->belongsTo('App\Role');
     }
    
     /*public function favorite(){
        return $this->hasMany(favouritebook::class);
    }*/

    public function verifyUser()
       {
      return $this->hasOne('App\VerifyUser');
      }
    
     


}
