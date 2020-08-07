<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Publication;
use Faker\Generator as Faker;

$factory->define(Publication::class, function (Faker $faker) {
    return [
        'property_id' => rand(1,100),
        'status_id' => 1,
    ];
});
