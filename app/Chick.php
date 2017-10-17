<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chick extends Model
{
    public $incrementing = false;
    protected $fillable = ["egg_id", "id", "name", "slug"];

    public function egg()
    {
        return $this->belongsTo("App\Egg");
    }
}
