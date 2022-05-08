<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->randomNumber(1) . $this->faker->randomNumber(9),
            'technology' => 'PHP,Laravel,JavaScript,React,Doker,AWS',
            'gr' => $this->faker->numberBetween(0,1000),
            'website_url' => $this->faker->url(),
        ];
    }
}
