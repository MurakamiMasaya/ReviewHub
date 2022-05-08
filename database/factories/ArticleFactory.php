<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition()
    {
        $image = [
            'sample1.png',
            'sample2.png',
            'sample3.png',
            'sample4.png',
            'sample5.png',
        ];

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
            'title' => $this->faker->realText(20),
            'contents' => $this->faker->realText(300),
            'image' => $this->faker->randomElement($image),
            'gr' => $this->faker->numberBetween(0,1000),
            'tag' => $this->faker->randomElement($tag),
            'url' => $this->faker->url(),
        ];
    }
}
