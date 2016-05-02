<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    //
    protected $fillable = ['title', 'content', 'status', 'category_id', 'user_id', 'published_at'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function excerpt($length = 25)
    {
        return Str::words($this->content, $length);
    }

    public function user()
    {

        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function setCategoryIdAttribute($value)
    {
        $this->attributes['category_id'] = ($value == 0) ? 'NULL' : $value;
    }

    public function scopePublished($query)
    {
        return $query->where('status', '=', 'opened');
    }

    public function scopeCategory($query, $id)
    {
        return $query->where('category_id', '=', $id);
    }

    public function hasTag($id)
    {
        if (is_null($this->tags)) {
            return false;
        }

        foreach ($this->tags as $tag) {
            if ($tag->id === $id) return true;
        }

        return false;
    }

    public function picture()
    {
        return $this->hasOne('App\Picture');

    }
}
