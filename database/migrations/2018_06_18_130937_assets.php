<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Assets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
           Schema::create('assets', function (Blueprint $table) {
            $table->increments('id',true);
            $table->integer('asset_subtype_code')->unsigned();
            $table->integer('asset_type_code')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('asset_subtype_code')->references('id')->on('assetsubtypes');
            $table->foreign('asset_type_code')->references('id')->on('assettypes');
            $table->foreign('user_id')->references('id')->on('people');
            $table->string('name',50);
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
        Schema::dropIfExists('assets');
    }
}
