<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'dni' => rand(10000000, 50000000),
        'phone' => $faker->tollFreePhoneNumber,
        'movil' => $faker->e164PhoneNumber,
        'address' => $faker->address,
        'address2' => '',
        'company' => $faker->company,
        'cuit' => rand(10000000, 50000000),
        'image' => '',
        'role' => 'ADMIN',
        'type_doc_iden' => 'D.N.I.',
    ];
});
