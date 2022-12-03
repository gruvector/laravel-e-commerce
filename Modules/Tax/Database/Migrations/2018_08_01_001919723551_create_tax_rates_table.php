<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tax_class_id')->unsigned()->index();
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('zip');
            $table->decimal('rate', 8, 4)->unsigned();
            $table->integer('position')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('tax_class_id')->references('id')->on('tax_classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_rates');
    }
}
