<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlashSaleProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flash_sale_product_orders', function (Blueprint $table) {
            $table->integer('flash_sale_product_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->integer('qty');

            $table->primary(['flash_sale_product_id', 'order_id']);
            $table->foreign('flash_sale_product_id')->references('id')->on('flash_sale_products')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flash_sale_product_orders');
    }
}
