<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePizzaOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizza_order', function (Blueprint $table) {
            $table->unsignedInteger('pizza_id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('quantity');

            $table->foreign('pizza_id')->references('id')->on('pizzas');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizza_order_size');
    }
}
