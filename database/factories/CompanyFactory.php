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
        // $technology = [
        //     'PHP,Laravel,JavaScript,React,Doker,AWS',
        //     'Apache,Docker,SQL,Java',
        //     'Swift,Go,Vue',
        // ];

        $companies = [
            'アルサーガパートナーズ',
            'GREE',
            'サイバーエージェント',
            'Salesforce',
            'Google',
            'Apple',
        ];

        $company_name = [
            '株式会社',
            '有限会社',
            '合同会社',
            '相互会社'
        ];

        // $condition = [
        //     '実務未経験,経験浅め(1~3年),新卒・第二新卒',
        //     '中途,フルリモート,実務未経験',
        //     '関西勤務,業務委託,副業',
        // ];

        return [
            'name' => $this->faker->randomElement($company_name). ' ' .$this->faker->randomElement($companies),
            'address' => $this->faker->address(),
            // 'phone' => $this->faker->randomNumber(1) . $this->faker->randomNumber(9),
            // 'condition' => $this->faker->randomElement($condition),
            // 'technology' => $this->faker->randomElement($technology),
            'website_url' => $this->faker->url(),
        ];
    }
}
