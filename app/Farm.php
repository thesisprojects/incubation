<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    public $incrementing = false;
    protected $fillable = ["name", "description", "address"];
}
