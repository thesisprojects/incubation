<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incubator extends Model
{
    public $incrementing = false;
    protected $fillable = ['name', 'slug'];

    public function eggs()
    {
    	return $this->hasMany("App\Egg");
    }
}
