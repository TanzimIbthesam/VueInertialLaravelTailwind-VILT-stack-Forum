<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title=$this->faker->text;
        return [
            //
            'title'=>$this->faker->text,
            'description'=>$this->faker->text,
             'slug'=>Str::slug($title),
             'user_id'=>$this->faker->numberBetween(1,7),
             'category_id'=>$this->faker->numberBetween(1,5)
             
        ];
    }
}
