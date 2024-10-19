<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('platform');
            $table->string('token');
            $table->timestamps();
            $table->increments('id');
        });
    }

    public function down()
    {
        Schema::drop('tokens');
    }
};
