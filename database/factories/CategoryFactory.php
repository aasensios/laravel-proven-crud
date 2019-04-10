<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        // 'name' => $faker->name,
        'name' => $faker->firstname,
        // 'description' => $faker->sentence,
        // 'description' => $faker->lastname,
        // 'description' => $faker->postcode,
        'description' => $faker->state,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
