<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('recipient');
            $table->string('recipient_mobile');
            $table->string('recipient_county');
            $table->string('recipient_district');
            $table->string('recipient_zipcode');
            $table->string('recipient_address');
            $table->string('shipping_method');
            $table->string('status');
            $table->integer('shipping_fee');
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
        Schema::dropIfExists('orders');
    }
}
