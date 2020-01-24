<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;



class Post extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;



    protected $fillable=['user_id', 'photo_id', 'category_id', 'title', 'body', 'slug'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }



    public function user(){
        return $this->belongsTo('App\User');
    }

    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }


    //comments

    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
