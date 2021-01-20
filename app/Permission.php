<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles() {

        return $this->belongsToMany(Role::class,'roles_permissions');
        //return $this->belongsToMany(Role::class);
            
     }
     public function users() {

        return $this->belongsToMany(User::class,'users_permissions');
            
     }


     public function inRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        return !! $role->intersect($this->roles)->count();
    }
}
