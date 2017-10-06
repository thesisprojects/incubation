<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class FarmPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createDefaultFarmPermissions(env('DB_CONNECTION', 'mysql'));
    }

    public function createDefaultFarmPermissions($connection)
    {
        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'view farms',
            'description' => 'All users that has this permission can view and search the farms.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'create farms',
            'description' => 'All users that has this permission can create a farm.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'edit farms',
            'description' => 'All users that has this permission can edit a farm.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'delete farms',
            'description' => 'All users that has this permission can delete a farm.',
        ]);

    }
}
