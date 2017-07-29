<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCOntainerPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('container_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('container_id')->unsigned();
            $table->integer('plan_id')->unsigned();

            $table->foreign('container_id')->references('id')->on('containers');
            $table->foreign('plan_id')->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('container_plans');

    }
}
