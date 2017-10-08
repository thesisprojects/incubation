<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Egg;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

class EggsController extends Controller
{
    public function getEggs()
    {
        $eggs = Auth::user()->farm()->first()->eggs()->with('farm')->paginate(10);
        return view("pages.eggs.index")->with([
            'eggs' => $eggs
        ]);
    }

    public function getCreate()
    {
        return view('pages.eggs.create');
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
            $egg->farm_id = Auth::user()->farm()->first()->id;
            $egg->id = Uuid::uuid1();
            $egg->save();
            return back()->with('status', 'Egg created.');
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function getEdit($id)
    {
        $egg = Egg::find($id);
        return view('pages.eggs.edit')->with('egg', $egg);
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
            $egg->expire_at = $data['expire_at'];
            $egg->save();
            return back()->with('status', 'Egg updated.');
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
