<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('frecuency');
            $table->date('date_start');
            $table->date('date_end')->nullable();
            $table->string('description',1000);
            $table->integer('frecuency_type_id')->unsigned();
            $table->integer('task_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('frecuency_type_id')->references('id')->on('frecuency_types');
            $table->foreign('task_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
