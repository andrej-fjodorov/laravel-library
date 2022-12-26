<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('journal_id')->unsigned()->nullable();
            //$table->foreign('journal_id')->references('id')->on('journal');
            $table->smallInteger('issuecode');
            $table->smallInteger('issueyear');
            $table->string('issuenumber',9);
            $table->date('issuedate')->nullable($value = true);   
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issue');
    }
}
