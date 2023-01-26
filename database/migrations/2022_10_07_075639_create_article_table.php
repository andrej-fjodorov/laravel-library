<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->smallInteger('pages');
            $table->text('annotation');
            $table->unsignedInteger('issue_id')->nullable();            
            //$table->foreign('issue_id')->references('id')->on('issue');
            $table->unsignedBigInteger('file_id')->nullable();
           // $table->foreign('file_id')->references('id')->on('files');                                  
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article');
    }
}
