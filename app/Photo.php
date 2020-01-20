<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['path'];

    public function post(){
        return $this->hasOne('App\Post');
    }
}
