<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Lifecycleevents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('lifecycleevents', function (Blueprint $table) {
            $table->increments('id',true);
            $table->integer('life_cycle_code')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->integer('responsible_person_code')->unsigned();
            $table->integer('status_code')->unsigned();
            $table->foreign('life_cycle_code')->references('id')->on('cyclephases');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('responsible_person_code')->references('id')->on('people');
            $table->foreign('status_code')->references('id')->on('statuses');
            $table->date('date_from');
            $table->date('date_to');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('lifecycleevents');
    }
}
