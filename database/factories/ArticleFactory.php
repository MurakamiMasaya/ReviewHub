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
        $article_image = [
            'sample1.png',
            'sample2.png',
            'sample3.png',
            'sample4.png',
            'sample5.png',
        ];

        $article_tag = [
            'PHP',
            'Laravel',
            'AWS',
            'React',
            'Java',
            'Swift',
        ];

        return [
            'article_title' => $this->faker->realText(20),
            'article_contents' => $this->faker->realText(300),
            'article_image' => $this->faker->randomElement($article_image),
            'article_gr' => $this->faker->numberBetween(0,1000),
            'article_tag' => $this->faker->randomElement($article_tag),
            'article_url' => $this->faker->url(),
        ];
    }
}
