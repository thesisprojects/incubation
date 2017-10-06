<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class EggPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createDefaultEggPermissions(env('DB_CONNECTION', 'mysql'));
    }

    public function createDefaultEggPermissions($connection)
    {
        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'view eggs',
            'description' => 'All users that has this permission can view and search the eggs.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'create eggs',
            'description' => 'All users that has this permission can create a egg.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'edit eggs',
            'description' => 'All users that has this permission can edit a egg.',
        ]);

        DB::connection($connection)->table('permissions')->insert([
            'id' => Uuid::uuid1(),
            'name' => 'delete eggs',
            'description' => 'All users that has this permission can delete a egg.',
        ]);

    }
}
