<?php

namespace App\Console\Commands;

use App\Chick;
use App\Egg;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;
use App\Notification;

class RemoveFromHatchery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hatchery:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove eggs in harchery where in hatchery for 3 days';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $eggs = Egg::whereNotNull('hatchery_id')->where('is_expired', 0)->get();
        $this->info('Processing ' . $eggs->count() . ' eggs.');
        foreach($eggs as $egg)
        {
            $daysInHatchery = Carbon::parse($egg->hatchery_date)->diffInDays();
            $this->info('Processing egg ' . $egg->name . ' with ' . $daysInHatchery . ' in hatchery.');
            if($daysInHatchery > 2)
            {
                $chickID = Uuid::uuid1();
                $today = Carbon::now();
                $data = [
                    "egg_id" => $egg->id,
                    "id" => $chickID,
                    "name" => "Chick ". $today->timestamp,
                    "slug" => "E".$egg->id."C".$chickID.'TS'.$today->timestamp
                ];
                $chick = new Chick($data);
                $chick->save();
                $egg->hatchery_id = null;
                $egg->hatch_date = Carbon::now();
                $egg->save();
                $notification = new Notification();
                $notification->id = Uuid::uuid1();
                $notification->content = $egg->slug . " with ID of " . $egg->id . " has been hatched to " . $chick->name;
                $notification->save();
                $this->info("Transformed egg ". $egg->name . ' to chick ' . $chick->name);
            }
        }
    }
}
