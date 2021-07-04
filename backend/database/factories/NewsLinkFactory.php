<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use App\Models\NewsLink;
use Faker\Generator as Faker;

$factory->define(NewsLink::class, function (Faker $faker) {
    return [
        'article_id' => function () {
            return factory(Article::class)->create()->id;
        },
        'news' => $faker->text(255),
        'url' => $faker->url,
    ];
});
