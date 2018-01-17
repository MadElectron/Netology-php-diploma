<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
    ];

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function delete()
    {
        foreach($this->questions as $q) {
            $q->delete();
        }

        parent::delete();
    }
}
