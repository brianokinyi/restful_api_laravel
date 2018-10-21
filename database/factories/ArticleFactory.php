<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker\Generator $faker){
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
    ];
});
