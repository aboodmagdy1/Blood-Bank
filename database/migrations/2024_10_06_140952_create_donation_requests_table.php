<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationRequestsTable extends Migration
{

	public function up()
	{
		Schema::create('donation_requests', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('patient_name');
			$table->string('patient_phone');
			$table->integer('city_id')->unsigned();
			$table->string('hospital_name')->nullable();
			$table->string('hospital_address')->nullable();
			$table->integer('blood_type_id')->unsigned();
			$table->integer('patient_age');
			$table->text('details')->nullable();
			$table->integer('bags_num');
			$table->decimal('latitude', 10, 8);
			$table->decimal('longitude', 10, 8);
			$table->integer('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}
