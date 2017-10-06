<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farm;
use Ramsey\Uuid\Uuid;

class FarmController extends Controller
{
    public function getFarms()
    {
    	$farms = Farm::paginate(10);
        return view("pages.farms.index")->with([
            'farms' => $farms
        ]);
    }

    public function getCreate()
    {
    	return view('pages.farms.create');
    }

    public function postCreate(Request $request)
    {
    	try {
            $this->validate($request, [
                'name' => 'required|min:2|max:45',
                'description' => 'required|min:2|max:45',
                'address' => 'required|min:2max:45',
            ]);
            $data = $request->all();
            $farm = new Farm($data);
            $farm->id = Uuid::uuid1();
			$farm->save();          
            return back()->with('status', 'Farm created.');
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
    
    public function getEdit($id)
    {
    	$farm = Farm::find($id);
    	return view('pages.farms.edit')->with('farm', $farm);
    }

    public function postUpdate(Request $request)
    {
    	try {
            $this->validate($request, [
                'name' => 'required|min:2|max:45',
                'description' => 'required|min:2|max:45',
                'description' => 'required|min:2max:45',
            ]);
            $data = $request->all();
            $id = $data['id'];
            $farm = Farm::find($id);
            $farm->name = $data['name'];
            $farm->description = $data['description'];
            $farm->address = $data['address'];
			$farm->save();          
            return back()->with('status', 'Farm created.');
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
