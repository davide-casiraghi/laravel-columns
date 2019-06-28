<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumnsTable extends Migration
{
    public function up()
    {
        Schema::create('columns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('columns_group')->nullable();
            $table->string('column_flex')->nullable();
            $table->string('separator_color')->nullable();
            $table->string('image_file_name')->nullable();
            $table->string('fontawesome_icon_class')->nullable();
            $table->string('icon_color')->nullable();
            $table->string('button_url')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('columns');
    }
}
