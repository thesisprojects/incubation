<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    public $incrementing = false;
    protected $fillable = ["name", "description", "address"];

    public function incubators()
    {
        return $this->hasMany('App\Incubator');
    }

    public function eggs()
    {
        return $this->hasMany('App\Egg');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
