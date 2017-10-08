<?php

use Illuminate\Database\Seeder;

class FarmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $farm = new \App\Farm([
            "id" => \Ramsey\Uuid\Uuid::uuid1(),
            "name" => "ABC Farm",
            "description" => "ABC SAMPLE FARM",
            "address" => "ABC street, Digos city"
        ]);

        $farm->save();
    }
}
