<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContainerTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('container_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_done')->nullable();
            $table->date('date_execution'); //indica la fecha que debe realizarse
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('task_id')->unsigned();
            $table->integer('container_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('task_id')->references('id')->on('tasks');
            $table->foreign('container_id')->references('id')->on('containers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('container_tasks');
    }
}
