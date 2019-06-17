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

$factory->define(DavideCasiraghi\LaravelColumns\Models\ColumnGroupTranslation::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'description' => $faker->paragraph,
        'button_text' => $faker->sentence($nbWords = 1, $variableNbWords = true),
        'image_alt' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'column_group_id' => 1,
        'locale' => 'en',
    ];
});
