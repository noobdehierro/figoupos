<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offerings', function (Blueprint $table) {
            $table->id();
            $table->string('qv_offering_id')->unique();
            $table->string('name');
            $table->text('description');
            $table->string('promotion')->nullable();
            $table->decimal('price');
            $table->decimal('seller_price');
            $table->unsignedBigInteger('brand_id');
            $table->string('type')->default('normal');
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            // Foreign Keys
            $table
                ->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offerings');
    }
}
