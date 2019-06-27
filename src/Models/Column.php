<?php

namespace DavideCasiraghi\LaravelColumns\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $table = 'columns';

    use Translatable;

    public $translatedAttributes = ['title', 'body', 'button_text', 'image_alt'];
    protected $fillable = [
        'columns_group',
        'column_flex',
        'separator_color',
        'image_file_name',
        'fontawesome_icon_class',
        'icon_color',
        'button_url',
    ];
}
