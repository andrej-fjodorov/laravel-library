<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoarticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infoarticle', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('inforelease_id')->unsigned()->nullable();
            //$table->foreign('inforelease_id')->references('id')->on('inforelease');
            $table->string('name',250)->nullable();
            $table->string('source',250)->nullable();
           // $table->string('edition',250)->nullable();
            $table->string('recieptdate',250)->nullable();
            $table->string('additionalinfo',250)->nullable();
            $table->unsignedBigInteger('file_id')->nullable();
            //$table->foreign('file_id')->references('id')->on('file'); 
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infoarticle');
    }
}
