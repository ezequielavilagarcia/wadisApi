<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFullnessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fullnesses', function (Blueprint $table) {
            $table->integer('container_state_id')->unsigned();
            $table->integer('value');
            
            $table->foreign('container_state_id')->references('id')->on('container_states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fullnesses');
    }
}
