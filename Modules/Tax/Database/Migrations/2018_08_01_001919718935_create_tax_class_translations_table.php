<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxClassTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_class_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tax_class_id')->unsigned();
            $table->string('locale');
            $table->string('label');

            $table->unique(['tax_class_id', 'locale']);
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
        Schema::dropIfExists('tax_class_translations');
    }
}
