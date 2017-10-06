<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Egg extends Model
{
    public $incrementing = false;
    protected $fillable = ["name", "slug", "expire_at"];
    
    public function incubator()
    {
    	return $this->belongsTo("App\Incubator");
    }
}
