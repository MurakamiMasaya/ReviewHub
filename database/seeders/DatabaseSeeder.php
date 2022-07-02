<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Company::factory(20)->create();
        \App\Models\School::factory(20)->create();
        \App\Models\Article::factory(20)->create();
        \App\Models\Event::factory(20)->create();
        \App\Models\ReviewCompany::factory(20)->create();
        \App\Models\ReviewSchool::factory(20)->create();
        \App\Models\ReviewArticle::factory(20)->create();
        \App\Models\ReviewEvent::factory(20)->create();
        $this->call([
            UserSeeder::class,
            ConditionSeeder::class,
            StackSeeder::class,
        ]);
    }
}
