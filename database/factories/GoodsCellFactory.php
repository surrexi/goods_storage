<?php

use App\Cell;
use App\GoodsCell;
use App\Product;
use Faker\Generator as Faker;

$factory->define(GoodsCell::class, function (Faker $faker) {
    return [
        'cell_id' => $faker->randomElement(Cell::pluck('id')->toArray()),
        'product_id' => $faker->randomElement(Product::pluck('id')->toArray()),
        'product_amount' => $faker->randomDigitNotNull
    ];
});
