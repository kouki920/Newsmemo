<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use App\Models\User;
use App\Models\Memo;
use Faker\Generator as Faker;

$factory->define(Memo::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'article_id' => function () {
            return factory(Article::class)->create()->id;
        },
        'body' => $faker->text(255),
    ];
});
