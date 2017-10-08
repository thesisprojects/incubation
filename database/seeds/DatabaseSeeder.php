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
        $this->call(FarmSeeder::class);
        $this->call(DashboardPermissionSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(UserPermissionSeeder::class);
        $this->call(DefaultUserSeeder::class);
        $this->call(EggPermissionSeeder::class);
        $this->call(FarmPermissionSeeder::class);
        $this->call(IncubatorPermissionSeeder::class);
    }
}
