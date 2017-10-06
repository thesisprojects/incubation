<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Incubator;
use Ramsey\Uuid\Uuid;
use App\Egg;

class IncubatorController extends Controller
{
    public function getIncubators()
    {
        $incubators = Incubator::with('eggs')->paginate(10);
        return view("pages.incubators.index")->with([
            'incubators' => $incubators
        ]);
    }

    public function getCreate()
    {
        return view('pages.incubators.create');
    }

    public function postCreate(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:2|max:45|unique:incubators',
                'slug' => 'required|min:2|max:45|unique:incubators',
            ]);
            $data = $request->all();
            $egg = new Incubator($data);
            $egg->id = Uuid::uuid1();
            $egg->save();
            return back()->with('status', 'Incubator created.');
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function getEdit($id)
    {
        $incubator = Incubator::find($id);
        return view('pages.incubators.edit')->with('incubator', $incubator);
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
            $incubator = Incubator::find($id);
            $incubator->name = $data['name'];
            $incubator->slug = $data['slug'];
            $incubator->save();
            return back()->with('status', 'Incubator updated.');
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function getEggAssigningPage($id)
    {
        $incubator = Incubator::with('eggs')->where('id', $id)->first();
        $eggs = Egg::whereNull('incubator_id')->get();
        return view('pages.incubators.eggs')->with(['incubator' => $incubator, 'eggs' => $eggs]);
    }

    public function postEggAssigningPage(Request $request)
    {
        try {
            $this->validate($request, [
                'egg' => 'required',
            ]);
            $data = $request->all();
            $id = $data['egg'];
            $egg = Egg::find($id);
            $egg->incubator_id = $data['incubator'];
            $egg->save();
            return back()->with('status', 'Egg added into incubator.');
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function postRemoveEgg(Request $request)
    {
        try {
            $data = $request->all();
            $id = $data['egg'];
            $egg = Egg::find($id);
            $egg->incubator_id = null;
            $egg->save();
            return back()->with('status', 'Egg added into incubator.');
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
