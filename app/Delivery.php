<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    public $incrementing = false;

    public function client()
    {
        return $this->belongsTo("App\Client");
    }

    public function egg()
    {
        return $this->belongsTo("App\Egg");
    }

    public function chick()
    {
        return $this->belongsTo("App\Chick");
    }

}
