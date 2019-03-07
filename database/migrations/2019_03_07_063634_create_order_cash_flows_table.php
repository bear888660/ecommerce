<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderCashFlowsTable extends Migration
{
    public function up()
    {
        Schema::create('order_cash_flows', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->string('provider');
            $table->string('order_id');
            $table->string('order_no');
            $table->string('trade_no');
            $table->string('message');
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
        Schema::dropIfExists('order_cash_flows');
    }
}
