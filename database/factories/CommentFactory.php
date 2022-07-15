<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->unique()->text(),
            'post_id' => $this->faker->numberBetween(1,150),
            'user_id' => $this->faker->numberBetween(1,20),
        ];
    }
}
