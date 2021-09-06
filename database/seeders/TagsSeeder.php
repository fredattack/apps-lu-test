<?php

namespace Database\Seeders;

use App\Models\tag;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        tag::factory()->count(10)->create();
    }
}
