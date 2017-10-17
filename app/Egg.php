<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Egg extends Model
{
    public $incrementing = false;
    protected $fillable = ["name", "slug", "expire_at", "farm_id"];
    
    public function incubator()
    {
    	return $this->belongsTo("App\Incubator");
    }

    public function hatchery()
    {
        return $this->belongsTo("App\Hatchery");
    }

    public function farm()
    {
        return $this->belongsTo("App\Farm");
    }
}
