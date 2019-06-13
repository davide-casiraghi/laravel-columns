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

$factory->define(DavideCasiraghi\LaravelColumns\Models\Column::class, function (Faker $faker) {
    return [
        'title:en' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'body:en' => $faker->paragraph,
        'title:en' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'button_text:en' => $faker->sentence($nbWords = 1, $variableNbWords = true),
        'image_alt:en' => $faker->sentence($nbWords = 1, $variableNbWords = true).".jpg",
        'columns_group' => 1,
        'image_file_name' => 'testImage.jpg',
        'icon_fontawesome' => '',
        'icon_color' => '#AA33BB',
        'button_url' => 'https://www.google.it',
    ];
});
