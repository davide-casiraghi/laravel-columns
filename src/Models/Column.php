<?php

namespace DavideCasiraghi\LaravelColumns\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $table = 'columns';

    use Translatable;

    public $translatedAttributes = ['title','body','button_text','image_alt'];
    protected $fillable = [
        'columns_group',
        'image_file_name',
        'icon_fontawesome',
        'icon_color',
        'button_url',
    ];
}
