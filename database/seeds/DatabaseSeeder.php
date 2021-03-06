<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DeliveryPermissionSeeder::class);
        $this->call(DashboardPermissionSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(UserPermissionSeeder::class);
        $this->call(DefaultUserSeeder::class);
        $this->call(EggPermissionSeeder::class);
        $this->call(FarmPermissionSeeder::class);
        $this->call(IncubatorPermissionSeeder::class);
        $this->call(ClientPermissionSeeder::class);
        $this->call(ChickPermissionSeeder::class);
        $this->call(HatcheryPermissionSeeder::class);
    }
}
