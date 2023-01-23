<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Schema;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book', function (Blueprint $table) {
            $table->id();
            $table->string('name',250);
            $table->string('additionalname',250)->nullable();
            $table->string('response',250)->nullable();
            $table->string('additionalresponse',10)->nullable();
            $table->string('bookinfo',250)->nullable();
            $table->string('publishplace',250)->nullable();
            $table->string('publishhouse',250)->nullable();
            $table->smallInteger('publishyear')->nullable();
            $table->string('tom',150)->nullable();
            $table->unsignedSmallInteger('pages')->nullable();
            $table->char('authorsign',3)->nullable();
            $table->string('code',8);
            $table->integer('numbersk')->nullable()->default(null);
            $table->date('recieptdate')->nullable()->default(null);
            $table->unsignedDecimal('cost',$precision = 8, $scale = 2)->nullable();
            $table->string('ISBN',50)->nullable();
            $table->text('annotation')->nullable();
            $table->unsignedInteger('withraw');  
            $table->unsignedBigInteger('rubric_id')->nullable();
            $table->unsignedBigInteger('file_id')->nullable();
            $table->uuid('uuid');
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
        Schema::dropIfExists('book');
    }
}
