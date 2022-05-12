<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReviewCompany>
 */
class ReviewCompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'company_id' => $this->faker->numberBetween(1, 100),
            'review' => $this->faker->realText(40),
            'gr' => $this->faker->numberBetween(1, 100),
        ];
    }
}
