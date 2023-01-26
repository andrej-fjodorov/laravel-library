<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal', function (Blueprint $table) {
            $table->id();
            $table->string('name',200);
            $table->string('ISSN',9);
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
        Schema::dropIfExists('journal');        
    }
}
