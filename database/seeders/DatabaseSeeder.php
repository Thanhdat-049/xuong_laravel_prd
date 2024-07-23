<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Rating;
use App\Models\Stock;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Article::truncate();
        Video::truncate();
        Image::truncate();
        Comment::truncate();
        Rating::truncate();

        User::factory(10)->create();

        for ($i = 0; $i < 10; $i++) {
            Article::create([
                'title' => fake()->title(),
                'content' => fake()->text(100)
            ]);
        }
        for ($i = 0; $i < 10; $i++) {
            Video::create([
                'title' => fake()->title(),
                'url' => fake()->url()
            ]);
        }
        for ($i = 0; $i < 10; $i++) {
            Image::create([
                'title' => fake()->title(),
                'url' => fake()->imageUrl()
            ]);
        }

        $commentable_type = ['App\Models\Video', 'App\Models\Image', 'App\Models\Article'];

        for ($i = 0; $i < 30; $i++) {
            Comment::create([
                'user_id' => rand(1, 10),
                'content' => fake()->text(100),
                'commentable_id' => rand(1, 10),
                'commentable_type' => fake()->randomElement($commentable_type),
            ]);
        }

        for ($i = 0; $i < 30; $i++) {
            Rating::create([
                'user_id' => rand(1, 10),
                'rating' => rand(1, 5),
                'rateable_id' => rand(1, 10),
                'rateable_type' => fake()->randomElement($commentable_type),
            ]);
        }
        for ($i = 0; $i < 5; $i++) {
            Stock::create([
                'product_name'=>fake()->name(),
                'quantity' => rand(5000, 10000),

            ]);
        }
    }
}
