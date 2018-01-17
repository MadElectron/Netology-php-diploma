<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'author_name',
        'author_email',
        'category_id',
        'content',
        'status_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function answer()
    {
        return $this->hasOne('App\Answer');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
