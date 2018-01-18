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

    public function questionsPublished()
    {
        return $this->questions()->where('status_id', 1);
    }

    public function questionsPending()
    {
        return $this->questions()->where('status_id', 2);
    }

    public function questionsHidden()
    {
        return $this->questions()->where('status_id', 3);
    }


    public function delete()
    {
        foreach($this->questions as $q) {
            $q->delete();
        }

        parent::delete();
    }
}
