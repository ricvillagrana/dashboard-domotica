<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_states', function (Blueprint $table) {
            $table->boolean('fan')->default('false');
            $table->boolean('night_light')->default('false');
            $table->boolean('light')->default('false');
            $table->decimal('temperature', 6, 2)->default(23);
            $table->boolean('temperature_auto')->default(true);
            $table->unsignedInteger('user_id');
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('current_states');
    }
}
