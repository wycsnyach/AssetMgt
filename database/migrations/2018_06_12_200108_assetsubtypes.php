<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Assetsubtypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

           Schema::create('assetsubtypes', function (Blueprint $table) {
            $table->increments('id',true);
            $table->integer('asset_category_code')->unsigned();
            $table->foreign('asset_category_code')->references('id')->on('categories');
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
        Schema::dropIfExists('assetsubtypes');
    }
}
