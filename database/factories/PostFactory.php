<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                return \App\Models\User::all()->random()->id;
            },
            'category_id' => function () {
                return \App\Models\Category::all()->random()->id;

                // return \App\Models\Category::random->create()->id;
            },
            'title' => fake()->sentence(1),
            'body' =>  fake()->paragraph(),
            'likes_count' => 0,
            'status' => 'active',
        ];
    }
}
