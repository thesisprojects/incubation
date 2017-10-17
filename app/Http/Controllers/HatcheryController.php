<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Hatchery;
use Illuminate\Support\Facades\Auth;

class HatcheryController extends Controller
{
    public function getHatcheries()
    {
        $hatcheries = Auth::user()->farm()->first()->hatcheries()->with('farm')->paginate(10);
        return view("pages.hatchery.index")->with([
            'hatcheries' => $hatcheries
        ]);
    }

    public function getHatcheryEggs($id)
    {
        $hatchery = Hatchery::where('id', $id)->with('eggs')->first();
        return view("pages.hatchery.eggs")->with([
            'hatchery' => $hatchery
        ]);
    }

    public function getCreate()
    {
        return view('pages.hatchery.create');
    }

    public function postCreate(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:2|max:45',
                'slug' => 'required|min:2|max:45',
            ]);
            $data = $request->all();
            $data['id'] = Uuid::uuid1();
            $hatchery = new Hatchery($data);
            $hatchery->farm_id = Auth::user()->farm()->first()->id;
            $hatchery->save();
            return back()->with('status', 'Hatchery created.');
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function getEdit($id)
    {
        $hatchery = Hatchery::find($id);
        return view('pages.hatchery.edit')->with('hatchery', $hatchery);
    }

    public function postUpdate(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:2|max:45',
                'slug' => 'required|min:2|max:45',
            ]);
            $data = $request->all();
            $id = $data['id'];
            $hatchery = Hatchery::find($id);
            $hatchery->name = $data['name'];
            $hatchery->slug = $data['slug'];
            $hatchery->save();
            return back()->with('status', 'Hatchery updated.');
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
