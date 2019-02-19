<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Smartphone::class, function (Faker $faker) {
    return [
        'brand_id' => rand(1,6),
        'store_id' => rand(1,2),
        'name' => $faker->name,
        'price' => rand(9000000, 12000000),
        'description' => $faker->paragraph,
        'stock' => rand(1, 10),
    ];
});
