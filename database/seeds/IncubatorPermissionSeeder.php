<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class IncubatorPermissionSeeder extends Seeder
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
            'name' => 'view incubators',
            'description' => 'All users that has this permission can view and search the incubators.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'create incubators',
            'description' => 'All users that has this permission can create a incubator.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'edit incubators',
            'description' => 'All users that has this permission can edit a incubator.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'delete incubators',
            'description' => 'All users that has this permission can delete a incubator.',
        ]);

    }
}
