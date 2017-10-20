<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Egg;
use App\Client;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveredEggs = Delivery::all()->pluck('egg_id');
        $clients = Client::all();
        $eggs = Egg::where('is_expired', '!=', 1)->whereNotNull('incubator_id')->whereNotIn('id', $deliveredEggs)->with('farm')->paginate(10);
        return view('pages.delivery.index')->with(['eggs' => $eggs, 'clients' => $clients]);
    }

    public function getDeliveries()
    {
        $deliveries = Delivery::with('client', 'egg')->paginate(10);
        return view('pages.delivery.deliveries')->with(['deliveries' => $deliveries]);
    }

    public function deliver(Request $request)
    {
        try {
            $data = $request->all();
            $delivery = new Delivery();
            $delivery->id = Uuid::uuid1();
            $delivery->client_id = $data['client_id'];
            $delivery->egg_id = $data['egg_id'];
            $delivery->save();
            return back()->with('status', 'Egg delivered.');
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
