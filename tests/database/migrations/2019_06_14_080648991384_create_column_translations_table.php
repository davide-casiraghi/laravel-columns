<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumnTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('column_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('column_id')->unsigned();

            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->string('button_text')->nullable();
            $table->string('image_alt')->nullable();

            $table->string('locale')->index();
            $table->unique(['column_id', 'locale']);
            $table->foreign('column_id')->references('id')->on('columns')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('column_translations');
    }
}
