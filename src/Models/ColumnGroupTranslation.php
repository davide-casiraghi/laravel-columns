<?php

namespace DavideCasiraghi\LaravelColumns\Models;

use Illuminate\Database\Eloquent\Model;

class ColumnGroupTranslation extends Model
{
    protected $table = 'column_group_translations';

    public $timestamps = false;
    protected $fillable = [
        'column_group_id',
        'title',
        'description',
        'button_text',
        'image_alt',
        'locale',
    ];
}
