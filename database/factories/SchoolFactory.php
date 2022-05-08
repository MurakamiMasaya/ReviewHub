<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\School>
 */
class SchoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name().'スクール',
            'online' => $this->faker->numberBetween(0,1),
            'address' => $this->faker->address(),
            'contents' => $this->faker->realText(300),
            'phone' => $this->faker->randomNumber(1) . $this->faker->randomNumber(9),
            'gr' => $this->faker->numberBetween(0,1000),
            'website_url' => $this->faker->url(),
        ];
    }
}
