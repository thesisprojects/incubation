<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Egg;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    public function downloadExpiredEggs()
    {
        $today = Carbon::now();
        $eggs = Egg::with('farm')->where('is_expired', 1)->get();
        $file = Excel::create('Eggs Expired ' . $today->copy()->toDateString(), function ($excel) use ($eggs) {
            $excel->sheet('Page 1', function ($sheet) use ($eggs) {
                $sheet->appendRow(1, array(
                    'URN', 'Farm', 'Slug', 'Name', 'Date expired', 'Date created'
                ));
                $sheet->cells('A1:F1', function ($cells) {
                    $cells->setBackground('#000000');
                    $cells->setFontColor('#ffffff');
                    $cells->setFontSize(16);
                    $cells->setFontWeight('bold');
                });
                foreach ($eggs as $egg) {
                    $sheet->appendRow(array(
                        $egg->id, $egg->farm->name, $egg->slug, $egg->name, $egg->expire_at, $egg->created_at
                    ));
                }
            });
        });
        $file->download('xls');
    }

    public function downloadDeilveryReports($from, $to)
    {
        $dateRange = [Carbon::parse($from), Carbon::parse($to)];
        $delivery = Delivery::with('client', 'egg')->whereBetween('created_at', $dateRange)->get();
        $file = Excel::create('Delivery report between ' . $dateRange[0]->copy()->toDateString() . '-' . $dateRange[1]->copy()->toDateString(), function ($excel) use ($delivery) {
            $excel->sheet('Page 1', function ($sheet) use ($delivery) {
                $sheet->appendRow(1, array(
                    'URN', 'Client', 'Egg', 'Delivery date'
                ));
                $sheet->cells('A1:D1', function ($cells) {
                    $cells->setBackground('#000000');
                    $cells->setFontColor('#ffffff');
                    $cells->setFontSize(16);
                    $cells->setFontWeight('bold');
                });
                foreach ($delivery as $delivery) {
                    $sheet->appendRow(array(
                        $delivery->id, $delivery->client->name, $delivery->egg->slug, $delivery->created_at
                    ));
                }
            });
        });
        $file->download('xls');
    }

    public function downloadAlmostExpired()
    {
        $eggs = Egg::whereBetween('expire_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('is_expired', 0)->get();
        $file = Excel::create('Eggs going to expire ' . Carbon::now()->startOfWeek(), function ($excel) use ($eggs) {
            $excel->sheet('Page 1', function ($sheet) use ($eggs) {
                $sheet->appendRow(1, array(
                    'URN', 'Days till expiration', 'Farm', 'Slug', 'Name', 'Date expired', 'Date created'
                ));
                $sheet->cells('A1:G1', function ($cells) {
                    $cells->setBackground('#000000');
                    $cells->setFontColor('#ffffff');
                    $cells->setFontSize(16);
                    $cells->setFontWeight('bold');
                });
                foreach ($eggs as $egg) {
                    $sheet->appendRow(array(
                        $egg->id, Carbon::parse($egg->expire_at)->diffInDays(Carbon::now()), $egg->farm->name, $egg->slug, $egg->name, $egg->expire_at, $egg->created_at
                    ));
                }
            });
        });
        $file->download('xls');
    }
}
