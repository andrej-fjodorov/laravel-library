<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInforeleaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inforelease', function (Blueprint $table) {
            $table->id();
            $table->string('name',200);
            $table->string('number',9);
            $table->unsignedSmallInteger('numbersk');
            $table->smallInteger('publishyear');
            $table->unsignedBigInteger('rubric_id')->nullable(); 
            $table->uuid('uuid');
            //$table->foreign('rubric_id')->references('id')->on('rubric');         
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inforelease');
    }
}
