<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'author_name',
        'author_email',
        'category',
        'content',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function status()
    {
        return $this->hasOne('App\Status');
    }
}
