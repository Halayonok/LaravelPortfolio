<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_data', function (Blueprint $table) {
            $table->unsignedInteger('model_id');
            $table->unsignedInteger('language_id');
            $table->string('title');

            $table->primary(['model_id', 'language_id']);

            $table->foreign('model_id')
                ->on('tags')
                ->references('id')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('language_id')
                ->on('languages')
                ->references('id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags_data');
    }
}
