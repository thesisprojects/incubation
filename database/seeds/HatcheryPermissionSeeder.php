<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class HatcheryPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createDefaultPermissionSeeder(env('DB_CONNECTION', 'mysql'));
    }

    public function createDefaultPermissionSeeder($connection)
    {
        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'view hatchery',
            'description' => 'All users that has this permission can view and search the hatcheries.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'create hatchery',
            'description' => 'All users that has this permission can create a hatchery.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'edit hatchery',
            'description' => 'All users that has this permission can edit a hatchery.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'delete hatchery',
            'description' => 'All users that has this permission can delete a hatchery.',
        ]);

    }
}
