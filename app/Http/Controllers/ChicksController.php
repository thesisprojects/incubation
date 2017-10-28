<?php

namespace App\Http\Controllers;

use App\Chick;
use Illuminate\Http\Request;

class ChicksController extends Controller
{
    public function getChicks()
    {
        $chicks = Chick::get();
        return view('pages.chicks.index')->with([
            'chicks' => $chicks
        ]);
    }
}
