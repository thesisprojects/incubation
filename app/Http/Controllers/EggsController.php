<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Egg;
use Ramsey\Uuid\Uuid;
use App\Farm;
use Illuminate\Support\Facades\Auth;

class EggsController extends Controller
{
    public function getEggs()
    {
        $eggs = Egg::with('farm')->paginate(10);
        return view("pages.eggs.index")->with([
            'eggs' => $eggs
        ]);
    }

    public function getCreate()
    {
        $farms = Farm::all();
        return view('pages.eggs.create')->with('farms', $farms);
    }

    public function postCreate(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:2|max:45',
                'slug' => 'required|min:2|max:45',
                'expire_at' => 'required',
            ]);
            $data = $request->all();
            $egg = new Egg($data);
            $egg->id = Uuid::uuid1();
            $egg->save();
            return back()->with('status', 'Egg created.');
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function getEdit($id)
    {
        $egg = Egg::with('farm')->find($id);
        $farms = Farm::all();
        return view('pages.eggs.edit')->with(['egg' => $egg, 'farms' => $farms]);
    }

    public function postUpdate(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:2|max:45',
                'slug' => 'required|min:2|max:45',
                'expire_at' => 'required',
            ]);
            $data = $request->all();
            $id = $data['id'];
            $egg = Egg::find($id);
            $egg->name = $data['name'];
            $egg->slug = $data['slug'];
            $egg->farm_id = $data['farm_id'];
            $egg->expire_at = $data['expire_at'];
            $egg->save();
            return back()->with('status', 'Egg updated.');
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
