<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEggsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eggs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('urn');
            $table->string('farm_id');
            $table->string('id')->unique();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->boolean('is_expired')->default(0);
            $table->string('incubator_id')->nullable();
            $table->string('hatchery_id')->nullable();
            $table->datetime('hatchery_date')->nullable();
            $table->datetime('expire_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eggs');
    }
}
