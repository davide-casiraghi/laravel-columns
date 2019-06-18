<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(DavideCasiraghi\LaravelColumns\Models\ColumnGroup::class, function (Faker $faker) {
    return [
        'title:en' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'description:en' => $faker->paragraph,
        'button_text:en' => $faker->sentence($nbWords = 1, $variableNbWords = true),
        'image_alt:en' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'bkg_color' => '#AA33BB',
        'group_title_color' => '#BBAABB',
        'group_title_font_size' => '2rem',
        'column_title_color' => '#0000CC',
        'column_title_font_size' => '2rem',
        'description_font_size' => '2rem',
        'link_style' => 1,
        'button_url' => 'https://www.google.it',
        'button_color' => '#AA33BB',
        'button_corners' => 2,
        'background_type' => 2,
        'opacity' => '',
        'background_image' => $faker->sentence($nbWords = 1, $variableNbWords = true).".jpg",
        'background_image_position' => '',
        'justify_content' => '',
        'flex_wrap' => '',
        'flex_flow' => '',
        'columns_flex' => '',
        'columns_padding' => '',
        'columns_box_sizing' => '',
        'columns_round_images' => '',
        'columns_images_width' => '',
        'columns_images_hide_mobile' => '',
        'icons_size' => '',
    ];
});
