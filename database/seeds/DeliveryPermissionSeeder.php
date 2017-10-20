<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class DeliveryPermissionSeeder extends Seeder
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
            'name' => 'deliver',
            'description' => 'All users that has this permission can deliver eggs',
        ]);

    }
}
