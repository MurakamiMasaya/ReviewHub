<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $tag = [
            'PHP',
            'Laravel',
            'AWS',
            'React',
            'Java',
            'Swift',
        ];

        return [
            'user_id' => $this->faker->numberBetween(1,10),
            'segment' => $this->faker->numberBetween(0,1),
            'title' => $this->faker->realText(40),
            'contents' => $this->faker->realText(300),
            'online' => $this->faker->numberBetween(0,1),
            'area' => $this->faker->city(),
            'capacity' => $this->faker->numberBetween(1,50),
            'contact_address' => $this->faker->randomNumber(1) . $this->faker->randomNumber(9),
            'contact_email' => $this->faker->unique()->safeEmail(),
            'gr' => $this->faker->numberBetween(0,1000),
            'tag' => $this->faker->randomElement($tag),
            'url' => $this->faker->url(),
        ];
    }
}
