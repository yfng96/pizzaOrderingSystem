<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePizzaOrderSizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizza_order_size', function (Blueprint $table) {
            $table->unsignedInteger('pizza_id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('size_id');
            $table->unsignedInteger('quantity');

            $table->foreign('pizza_id')->references('id')->on('pizzas');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('size_id')->references('id')->on('sizes');
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
        Schema::dropIfExists('pizza_order_size');
    }
}
