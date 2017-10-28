<?php

namespace App\Http\Controllers;

use App\Hatchery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Incubator;
use Ramsey\Uuid\Uuid;
use App\Egg;
use Illuminate\Support\Facades\Auth;
use App\Farm;
use App\Delivery;

class IncubatorController extends Controller
{
    public function getIncubators()
    {
        $deliveredEggs = Delivery::all()->pluck('egg_id');
        $incubators = Incubator::with(['eggs' => function ($query) use ($deliveredEggs) {
        }, 'farm', 'farm.hatcheries'])->paginate(10);
        return view("pages.incubators.index")->with([
            'incubators' => $incubators,
        ]);
    }

    public function getCreate()
    {
        $farms = Farm::all();
        return view('pages.incubators.create')->with('farms', $farms);
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
        $incubator = Incubator::with('farm')->find($id);
        $farms = Farm::all();
        return view('pages.incubators.edit')->with(['incubator' => $incubator, 'farms' => $farms]);
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
            $incubator->farm_id = $data['farm_id'];
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
        $deliveredEggs = Delivery::whereNotNull('egg_id')->pluck('egg_id');
        $incubator = Incubator::with(['eggs' => function ($query) use ($deliveredEggs) {
            $query->whereNotIn('id', $deliveredEggs)->whereNull('hatch_date');
        }, 'farm', 'farm.hatcheries'])->where('id', $id)->first();
        $eggs = $incubator->farm->eggs()->whereNull('incubator_id')->whereNull('hatchery_id')->whereNull('hatch_date')->whereNotIn('id', $deliveredEggs)->where('is_expired', 0)->get();
        $hatcheries = $incubator->farm->hatcheries;
        return view('pages.incubators.eggs')->with(['incubator' => $incubator, 'eggs' => $eggs, 'hatcheries' => $hatcheries]);
    }

    public function postTransferEgg(Request $request)
    {
        try {
            $data = $request->all();
            $egg = Egg::find($data['egg']);
            $egg->incubator_id = null;
            $egg->hatchery_id = $data['hatchery_id'];
            $egg->hatchery_date = Carbon::now();
            $egg->expire_at = Carbon::parse(Carbon::now()->addDays(6))->toDateString();
            $egg->save();
            return back()->with('status', 'Egg transfered to hatchery.');
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function postBulkHatceryTransfer(Request $request)
    {
        try {
            $data = $request->all();
            $incubator = Incubator::find($data['incubator']);
            $eggs = $incubator->eggs()->get();
            $invalidEgg = 0;
            foreach ($eggs as $egg) {
                $availableForTransfer = Carbon::now()->diffInDays(Carbon::parse($egg->created_at)) > 17;
                if ($availableForTransfer) {
                    $egg->incubator_id = null;
                    $egg->hatchery_id = $data['hatchery_id'];
                    $egg->hatchery_date = Carbon::now();
                    $egg->save();
                } else {
                    $invalidEgg++;
                }
            }

            return back()->with('status', ($eggs->count() - $invalidEgg) . ' eggs transfered to hatchery.');
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
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
