<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'gender' => $faker->randomElement($array = ['男性', '女性', '無回答']),
        'email' => substr($faker->unique()->userName(), 0, 10) . '@' . $faker->safeEmailDomain(),
        'age' => $faker->randomElement(['10', '20', '30', '40', '50', '60', '70', '80', '90']),
        'content' => $faker->text(255),
    ];
});
