<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'photo_id', 'is_active', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    protected function setNameAttribute($name){
        $this->attributes['name'] = strtolower($name);
    }

    public function getNameAttribute($name){
        return ucwords($name);
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }

    Public function photo(){
        return $this->belongsTo('App\Photo');
    }

    public function IsAdmin(){

            if($this->role) {
                if ($this->role->name == 'administrator' && $this->is_active == 1) {
                    return true;
                }
            }

        return false;
    }

    //post

    public function posts(){
        return $this->hasMany('App\Post');
    }
}
