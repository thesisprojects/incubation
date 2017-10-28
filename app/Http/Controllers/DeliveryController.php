<?php

namespace App\Http\Controllers;

use App\Chick;
use App\Delivery;
use App\Egg;
use App\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveredEggs = Delivery::where('type', 'egg')->pluck('egg_id');
        $clients = Client::all();
        $eggs = Egg::where('is_expired', '!=', 1)->whereNotNull('incubator_id')->whereNotIn('id', $deliveredEggs)->with('farm')->paginate(10);
        return view('pages.delivery.index')->with(['eggs' => $eggs, 'clients' => $clients]);
    }

    public function getDeliveries()
    {
        $deliveries = Delivery::with('client', 'egg', 'chick')->paginate(10);
        return view('pages.delivery.deliveries')->with(['deliveries' => $deliveries]);
    }

    public function getReceipt($id)
    {
        $delivery = Delivery::with('client', 'chick', 'egg')->where('id', $id)->firstOrFail();
        return view('pages.delivery.receipt')->with('delivery', $delivery);
    }

    public function getMonthChartData()
    {
        $january = Delivery::whereBetween('created_at', $this->getDateRange('January'))->count();
        $february = Delivery::whereBetween('created_at', $this->getDateRange('February'))->count();
        $march = Delivery::whereBetween('created_at', $this->getDateRange('March'))->count();
        $april = Delivery::whereBetween('created_at', $this->getDateRange('April'))->count();
        $may = Delivery::whereBetween('created_at', $this->getDateRange('May'))->count();
        $june = Delivery::whereBetween('created_at', $this->getDateRange('June'))->count();
        $july = Delivery::whereBetween('created_at', $this->getDateRange('July'))->count();
        $august = Delivery::whereBetween('created_at', $this->getDateRange('August'))->count();
        $september = Delivery::whereBetween('created_at', $this->getDateRange('September'))->count();
        $october = Delivery::whereBetween('created_at', $this->getDateRange('October'))->count();
        $november = Delivery::whereBetween('created_at', $this->getDateRange('November'))->count();
        $december = Delivery::whereBetween('created_at', $this->getDateRange('December'))->count();
        return [
            $january,
            $february,
            $march,
            $april,
            $may,
            $june,
            $july,
            $august,
            $september,
            $october,
            $november,
            $december,
        ];
    }

    public function getDateRange($month)
    {
        $year = Carbon::now()->year;
        return [Carbon::parse('first day of ' . $month . ' ' . $year)->startOfDay(), Carbon::parse('last day of ' . $month . ' ' . $year)->endOfDay()];
    }

    public function getDeliveryChicks()
    {
        $deliveryChicks = Delivery::where('type', 'chick')->pluck('chick_id');
        $clients = Client::all();
        $chicks = Chick::whereNotIn('id', $deliveryChicks)->paginate(10);
        return view('pages.delivery.chicks')->with(['chicks' => $chicks, 'clients' => $clients]);
    }

    public function deliver(Request $request)
    {
        try {
            $data = $request->all();
            $delivery = new Delivery();
            $delivery->id = Uuid::uuid1();
            $delivery->client_id = $data['client_id'];
            $delivery->egg_id = isset($data['egg_id']) ? $data['egg_id'] : null;
            $delivery->chick_id = isset($data['chick_id']) ? $data['chick_id'] : null;
            $delivery->type = $data['type'];
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
