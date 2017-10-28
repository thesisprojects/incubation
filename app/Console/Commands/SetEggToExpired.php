<?php

namespace App\Console\Commands;

use App\Notification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;
use App\Egg;

class SetEggToExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eggs:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $this->info('Starting expiration process');
        $eggs = Egg::where('is_expired', 0)->whereNotNull('expire_at')->get();
        $numberOfEggsMarkedAsExpired = 0;
        foreach($eggs as $egg)
        {
            $this->info("Checking " . $egg->slug);

            $eggIsExpire = Carbon::parse($egg->expire_at)->isPast();
            if($eggIsExpire)
            {
                $this->info("Setting " . $egg->slug . ' as expired');
                $egg->is_expired = 1;
                $egg->save();
                $numberOfEggsMarkedAsExpired++;
                $notification = new Notification();
                $notification->id = Uuid::uuid1();
                $notification->content = $egg->slug . " with ID of " . $egg->id . " has been marked as expired";
                $notification->save();
                $this->info("Notification pushed!");
            }
        }
        $this->info($numberOfEggsMarkedAsExpired . ' eggs has been marked as expired');
    }
}
