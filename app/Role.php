<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function setNameAttribute($name){
        $this->attributes['name'] = strtolower($name);
    }
}
