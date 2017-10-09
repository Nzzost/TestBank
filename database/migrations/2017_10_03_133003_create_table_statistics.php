<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStatistics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('statistics', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('deposit_id');
		    $table->integer('operation_id');
		    $table->integer('percent');
		    $table->float('balance_before');
		    $table->float('percent_sum');
		    $table->float('balance_after');
		    $table->timestamps();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('statistics');
    }
}
