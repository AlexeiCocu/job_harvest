<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CVFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'education' => $this->faker->sentence(10),
            'work' => $this->faker->sentence(10),
            'experience' => $this->faker->realText(100),
            'stack' => $this->faker->sentence(10)

        ];
    }
}
