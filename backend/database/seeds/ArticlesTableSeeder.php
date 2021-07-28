<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 2)->create()->each(function ($user) {
            factory(App\Models\Article::class, 15)->create(['user_id' => $user->id])->each(function ($article) {
                factory(App\Models\NewsLink::class, 1)->create(['article_id' => $article->id]);
            });
        });
    }
}
