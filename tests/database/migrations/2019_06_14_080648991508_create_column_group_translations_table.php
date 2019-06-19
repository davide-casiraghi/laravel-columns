<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumnGroupTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('column_group_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('column_group_id')->unsigned();

            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('button_text')->nullable();
            $table->string('image_alt')->nullable();

            $table->string('locale')->index();
            $table->unique(['column_group_id', 'locale']);
            $table->foreign('column_group_id')->references('id')->on('column_groups')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('column_group_translations');
    }
}
