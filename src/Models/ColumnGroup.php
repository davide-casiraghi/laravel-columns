<?php

namespace DavideCasiraghi\LaravelColumns\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ColumnGroup extends Model
{
    protected $table = 'column_groups';

    use Translatable;

    public $translatedAttributes = ['title','description','button_text','image_alt'];
    protected $fillable = [
        'number_of_columns_shown',
        'bkg_color',
        'group_title_color',
        'group_title_font_size',
        'column_title_color',
        'column_title_font_size',
        'description_font_size',
        'link_style',
        'button_url',
        'button_color',
        'button_corners',
        'background_type',
        'opacity',
        'background_image',
        'background_image_position',
        'justify_content',
        'flex_wrap',
        'flex_flow',
        'columns_flex',
        'columns_padding',
        'columns_box_sizing',
        'columns_round_images',
        'columns_images_width',
        'columns_images_hide_mobile',
        'icons_size',
    ];
}
