<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientablesTable extends Migration
{

	public function up()
	{
		Schema::create('clientables', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id')->unsigned();
			$table->morphs('clientable');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clientables');
	}
}
