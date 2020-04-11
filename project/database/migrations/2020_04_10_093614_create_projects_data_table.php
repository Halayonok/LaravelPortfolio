<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_data', function (Blueprint $table) {
            $table->unsignedInteger('model_id');
            $table->unsignedInteger('language_id');
            $table->string('title');
            $table->longText('content')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            $table->primary(['model_id', 'language_id']);

            $table->foreign('model_id')
                ->on('projects')
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
        Schema::dropIfExists('projects_data');
    }
}
