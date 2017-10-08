<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incubator extends Model
{
    public $incrementing = false;
    protected $fillable = ['name', 'slug', 'farm_id'];

    public function eggs()
    {
    	return $this->hasMany("App\Egg");
    }

    public function farm()
    {
        return $this->belongsTo("App\Farm");
    }
}
