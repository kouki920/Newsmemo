<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Contact;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'gender' => $faker->randomElement($array = ['男性', '女性', '無回答']),
        'email' => Str::random(15) . '@sample.com',
        'age' => $faker->randomElement(['10', '20', '30', '40', '50', '60', '70', '80', '90']),
        'content' => $faker->text(255),
    ];
});
