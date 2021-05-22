<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use App\Models\User;
use Faker\Generator as Faker;

/**
 * ArticleModelに対するファクトリを作成
 * 外部キー制約を持つカラム(user_id)を取り扱うので値として参照先のモデルを生成するfactory関数を返すクロージャをセット
 */

$factory->define(Article::class, function (Faker $faker) {
    return [
        'body' => $faker->text(255),
        'user_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
