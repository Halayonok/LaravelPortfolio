<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_tags', function (Blueprint $table) {
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('tag_id');

            $table->primary(['project_id', 'tag_id']);

            $table->foreign('project_id')
                ->on('projects')
                ->references('id')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('tag_id')
                ->on('tags')
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
        Schema::dropIfExists('projects_tags');
    }
}
