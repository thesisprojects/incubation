<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class ChickPermissionSeeder extends Seeder
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
            'name' => 'view chicks',
            'description' => 'All users that has this permission can view and search the chicks.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'create chicks',
            'description' => 'All users that has this permission can create a chick.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'edit chicks',
            'description' => 'All users that has this permission can edit a chick.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'delete chicks',
            'description' => 'All users that has this permission can delete a chick.',
        ]);

    }
}
