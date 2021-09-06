<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::factory()->count(50)->create()->each(
            function (News $news){
                $news->tags()->sync(Tag::inRandomOrder()->limit(rand(1,5))->get());
            }
        );
        
    }
}
