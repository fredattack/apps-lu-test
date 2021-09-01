<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->sentence(8, true),
            'content'=>$this->faker->paragraph(3, true),
            'is_published'=>$this->faker->boolean (85),
            'created_at'=>$this->faker->dateTime (),
            'updated_at'=>$this->faker->dateTime ()
        ];
    }
}
