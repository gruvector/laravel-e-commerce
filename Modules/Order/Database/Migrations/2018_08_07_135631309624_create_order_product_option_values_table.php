<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductOptionValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product_option_values', function (Blueprint $table) {
            $table->integer('order_product_option_id')->unsigned();
            $table->integer('option_value_id')->unsigned();
            $table->decimal('price', 18, 4)->unsigned()->nullable();

            $table->primary(['order_product_option_id', 'option_value_id'], 'order_product_option_id_option_value_id_primary');
            $table->foreign('order_product_option_id')->references('id')->on('order_product_options')->onDelete('cascade');
            $table->foreign('option_value_id')->references('id')->on('option_values')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product_option_values');
    }
}
