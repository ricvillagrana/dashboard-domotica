<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->increments('id');
            $table->time('profile_time_start');
            $table->time('profile_time_finish');
            $table->time('profile_sleep_start');
            $table->time('profile_sleep_finish');
            $table->float('profile_temperature');
            $table->string('profile_name');
            $table->string('profile_description')->nullable();
            $table->string('mod_user');
            $table->date('mod_date');
            $table->time('mod_hour');
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
        Schema::dropIfExists('data');
    }
}
