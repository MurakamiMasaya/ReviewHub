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
            'company_name' => $this->faker->company(),
            'company_address' => $this->faker->address(),
            'company_phone' => $this->faker->randomNumber(1) . $this->faker->randomNumber(9),
            'company_technology' => 'PHP,Laravel,JavaScript,React,Doker,AWS',
            'company_gr' => $this->faker->numberBetween(0,1000),
            'company_website_url' => $this->faker->url(),
        ];
    }
}
