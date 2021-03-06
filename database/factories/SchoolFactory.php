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
            // 'address' => $this->faker->address(),
            // 'phone' => $this->faker->randomNumber(1) . $this->faker->randomNumber(9),
            'website_url' => $this->faker->url(),
        ];
    }
}
