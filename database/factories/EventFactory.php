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

        $scheduled_date = $this->faker->dateTimeBetween('-1year', '+1year');
        $add_date = $this->faker->numberBetween(1,30);

        return [
            'user_id' => $this->faker->numberBetween(1,10),
            'segment' => $this->faker->numberBetween(0,1),
            'title' => $this->faker->realText(40),
            'contents' => $this->faker->realText(300),
            'online' => $this->faker->numberBetween(0,1),
            'area' => $this->faker->city(),
            'capacity' => $this->faker->numberBetween(1,50),
            'start_date' => $scheduled_date->format('Y-m-d H:i:s'),
            'end_date' => $scheduled_date->modify('+'. $add_date . 'day')->format('Y-m-d H:i:s'),
            'contact_address' => $this->faker->randomNumber(1) . $this->faker->randomNumber(9),
            'contact_email' => $this->faker->unique()->safeEmail(),
            'gr' => $this->faker->numberBetween(0,1000),
            'tag' => $this->faker->randomElement($tag),
            'url' => $this->faker->url(),
        ];
    }
}
