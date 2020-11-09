<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Property;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Property::class, function (Faker $faker) {

    $name = $faker->state.", ".$faker->address;
    return [

        'title' => $name,
        'code' => $faker->unique()->swiftBicNumber,
        'slug' => Str::slug($name),
        'address' => $faker->address,
        'description' => $faker->paragraph($nbSentences = 4, $variableNbSentences = false),
        'status_id' => 5,
        'property_type_id' => rand(1,6), 
        'neighborhood_id' => rand(1,3),
        // 'features'=> [{'feature_id': 4, 'value':1},{'feature_id': 5, 'value':3},{'feature_id': 6, 'value':1},{'feature_id': 7, 'value':2},{'feature_id': 8, 'value':1},{'feature_id': 9},{'feature_id': 10},{'feature_id': 11},{'feature_id': 16, 'value':80},{'feature_id': 17, 'value':430},{'feature_id': 18, 'value':2}],
        'user_owner_id' => 1,
        'latitude' => $faker->latitude($min = -36, $max = -36),
        'longitude' =>  $faker->longitude($min = -56, $max = -56),
        


    ];
});
