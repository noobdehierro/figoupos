<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('operacion');
            $table->unsignedBigInteger('order_id');
            $table->string('client_name');
            $table->string('api_key');
            $table->string('api_endpoint');
            $table->longText('request');
            $table->string('code');
            $table->longText('response');
            $table->timestamps();

            $table
                ->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}