<?php

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'price' => $faker->randomFloat(2, 0, 999999), // randomFloat($nbMaxDecimals = null, $min = 0, $max = null)
        'description' => $faker->sentence,
        'category_id' => $faker->numberBetween(1, 5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
