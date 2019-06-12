<?php

namespace DavideCasiraghi\LaravelColumns\Models;

use Illuminate\Database\Eloquent\Model;

class ColumnTranslation extends Model
{
    protected $table = 'column_translations';

    public $timestamps = false;
    protected $fillable = [
        'column_id',
        'title',
        'body',
        'button_text',
        'image_alt',
        'locale',
    ];
}
