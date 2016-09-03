<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
       'title', 'content', 'class_level', 'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function choices()
    {
        return $this->hasMany('App\Choice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scores()
    {
        return $this->hasMany('App\Score');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublish($query)
    {
        return $query->where('status','=','publish');
    }

    /**
     * @param $query
     * @param $class_level
     * @return mixed
     */
    public function scopeClass($query, $class_level)
    {
        if($class_level == 'first_class')
            $class_level = 'premiere';
        else
            $class_level = 'terminale';

        return $query->where('class_level','=',$class_level);
    }
}
