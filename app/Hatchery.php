<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hatchery extends Model
{
    public $incrementing = false;
    protected $fillable = ['id', 'name', 'slug', 'farm_id'];

    public function farm()
    {
        return $this->belongsTo('App\Farm');
    }

    public function eggs()
    {
        return $this->hasMany('App\Egg');
    }
}
