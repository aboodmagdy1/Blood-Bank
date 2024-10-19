<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{

	public function up()
	{
		Schema::create('clients', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('phone');
			$table->string('email');
			$table->string('name');
			$table->integer('blood_type_id')->unsigned();
			$table->string('password');
			$table->string('reset_code', 6)->nullable();
			$table->date('last_donation_date')->nullable();
			$table->date('d_o_b');
			$table->integer('city_id')->unsigned();
			$table->boolean('is_active')->default(1);
			$table->string('api_token', 60)->unique()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
