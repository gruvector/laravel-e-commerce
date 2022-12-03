<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('file_id')->unsigned()->index();
            $table->morphs('entity');
            $table->string('zone')->index();
            $table->timestamps();

            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity_files');
    }
}
