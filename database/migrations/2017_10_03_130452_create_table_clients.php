<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('clients', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('id_number');
		    $table->string('first_name');
		    $table->string('last_name');
		    $table->tinyInteger('gender');
		    $table->dateTime('birthday');
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
	    Schema::dropIfExists('clients');
    }
}
