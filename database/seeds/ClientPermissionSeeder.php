<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class ClientPermissionSeeder extends Seeder
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
            'name' => 'view client',
            'description' => 'All users that has this permission can view and search the clients.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'create client',
            'description' => 'All users that has this permission can create a client.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'edit client',
            'description' => 'All users that has this permission can edit a client.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'delete client',
            'description' => 'All users that has this permission can delete a client.',
        ]);

    }
}
