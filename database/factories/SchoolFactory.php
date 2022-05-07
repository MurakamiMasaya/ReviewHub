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
            'school_name' => $this->faker->name().'スクール',
            'school_online' => $this->faker->numberBetween(0,1),
            'school_address' => $this->faker->address(),
            'school_contents' => $this->faker->realText(300),
            'school_phone' => $this->faker->randomNumber(1) . $this->faker->randomNumber(9),
            'school_gr' => $this->faker->numberBetween(0,1000),
            'school_website_url' => $this->faker->url(),
        ];
    }
}
