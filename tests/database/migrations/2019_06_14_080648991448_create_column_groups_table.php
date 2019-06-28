<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumnGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('column_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bkg_color')->nullable();
            $table->string('text_alignment')->nullable();
            $table->string('group_title_color')->nullable();
            $table->string('group_title_font_size')->nullable();
            $table->string('column_title_color')->nullable();
            $table->string('column_title_font_size')->nullable();
            $table->string('description_font_size')->nullable();
            $table->string('link_style')->nullable();
            $table->string('button_url')->nullable();
            $table->string('button_color')->nullable();
            $table->string('button_corners')->nullable();
            $table->string('background_type')->nullable();
            $table->string('opacity')->nullable();
            $table->string('background_image')->nullable();
            $table->string('background_image_position')->nullable();
            $table->string('justify_content')->nullable();
            $table->string('flex_wrap')->nullable();
            $table->string('flex_flow')->nullable();
            $table->string('columns_flex')->nullable();
            $table->string('columns_padding')->nullable();
            $table->string('columns_box_sizing')->nullable();
            $table->string('columns_round_images')->nullable();
            $table->string('columns_images_width')->nullable();
            $table->string('columns_images_hide_mobile')->nullable();
            $table->string('icons_size')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('column_groups');
    }
}
