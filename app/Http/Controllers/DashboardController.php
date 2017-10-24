<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Egg;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::now();
        $dateRange = [$today->copy()->startOfMonth()->startOfDay(),$today->copy()->endOfMonth()->endOfDay()];
        $monthDelivery = Delivery::whereBetween('created_at', $dateRange)->count();
        $todayDelivery = Delivery::whereBetween('created_at', [$today->copy()->startOfDay(), $today->copy()->endOfDay()])->count();
        $overAllDelivery = Delivery::all()->count();
        $rejectEggs = Egg::where('is_expired', 1)->count();
        $thisWeeksExpire = Egg::whereBetween('expire_at', [$today->copy()->startOfWeek()->startOfDay(), $today->copy()->endOfWeek()->endOfDay()])->get();
        $almostExpired = 0;
        $todaysExpiree = Egg::whereBetween('expire_at', [$today->copy()->startOfDay(), $today->copy()->endOfDay()])->count();
        $thisMonthsExpiree = Egg::whereBetween('expire_at', $dateRange)->count();

        foreach ($thisWeeksExpire as $egg)
        {
            if(Carbon::parse($egg->expire_at)->isPast())
            {
                continue;
            }
           $almostExpired++;
        }
        return view('pages.dashboard.index')->with([
            'monthDelivery' => $monthDelivery,
            'todayDelivery' => $todayDelivery,
            'overallDelivery' => $overAllDelivery,
            'rejectedEggs' => $rejectEggs,
            'thisWeeksExpiree' => $almostExpired,
            'todaysExpiree' => $todaysExpiree,
            'thisMonthsExpiree' => $thisMonthsExpiree,
        ]);
    }
}
