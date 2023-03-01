<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExerciseFactory extends Factory
{
    public function definition()
    {
        return [
            'ex_name' => ucfirst($this->faker->unique()->word),
            'ex_description' => $this->faker->paragraphs(2, true),
            'ex_duration' => $this->faker->numberBetween(10, 99),
            'ex_thumbnail_url' => $this->faker->randomElement(['exercise1.jpg', 'exercise2.jpg', 'exercise3.jpg', 'exercise4.jpg', 'exercise5.png']),
            'ex_video_url' => $this->faker->randomElement(['exercise1.mp4', 'exercise2.mp4', 'exercise3.mp4', 'exercise4.mp4', 'exercise5.mp4']),
        ];
    }
}