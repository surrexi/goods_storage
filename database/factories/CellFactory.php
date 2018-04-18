<?php

use App\Cell;
use Faker\Generator as Faker;

$factory->define(Cell::class, function (Faker $faker) {
    return [
        'barcode' => $faker->unique()->isbn13,
        'number' => $faker->numerify(strtoupper($faker->randomLetter) . ' ###')
    ];
});
