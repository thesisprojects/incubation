<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $incrementing = false;
    protected $fillable = ["id", "name", "address"];
}
