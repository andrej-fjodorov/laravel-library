<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatreleaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statrelease', function (Blueprint $table) {           
            $table->id();
            $table->string('name',250);
            $table->string('additionalname',250)->nullable();
            $table->string('response',250)->nullable();
            $table->string('publishplace',250)->nullable();
            $table->smallInteger('publishyear')->nullable();
            $table->unsignedSmallInteger('pages')->nullable();
            $table->date('recieptdate')->nullable();
            $table->unsignedDecimal('cost',$precision = 8, $scale = 2)->nullable();
            $table->string('code',8);
            $table->char('authorsign')->nullable();
            $table->unsignedInteger('numbersk')->nullable();            
            $table->unsignedBigInteger('rubric_id')->nullable();
           // $table->foreign('rubric_id')->references('id')->on('rubric');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statrelease');
    }
}
