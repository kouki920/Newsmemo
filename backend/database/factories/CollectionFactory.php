<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Collection;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Collection::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'name' => $faker->text(255),
    ];
});
