<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use Sluggable;

    protected $guarded = [];
//    protected $fillable = ['user_id','title','post_image','body','file'];



    public function sluggable()
    {
        return [
            'slug' => [
                'source'  => 'title',
                'onUpdate'=> true,

            ]
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

//    public function setPostImageAttribute($value)
//    {
//        $this->attributes['post_image']  = asset($value);
//    }

//    public function getPostImageAttribute($value)
//    {
//        return asset($value);
//    }

    public function getPostImageAttribute($value) {

    if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
    return $value;
    }
    return asset('storage/' . $value);
    }

}
