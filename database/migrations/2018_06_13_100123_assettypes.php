<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Assettypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('assettypes', function (Blueprint $table) {
            $table->increments('id',true);
            $table->integer('asset_subtype_code')->unsigned();
            $table->foreign('asset_subtype_code')->references('id')->on('assetsubtypes');
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
        Schema::dropIfExists('assettypes');

    }
}
