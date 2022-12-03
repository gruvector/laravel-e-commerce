<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteMetaKeywordsColumnFromMetaDataTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meta_data_translations', function (Blueprint $table) {
            $table->dropColumn('meta_keywords');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meta_data_translations', function (Blueprint $table) {
            $table->text('meta_keywords')->nullable()->after('meta_title');
        });
    }
}
