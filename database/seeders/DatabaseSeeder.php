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
        \App\Models\Company::factory(100)->create();
        \App\Models\School::factory(100)->create();
        \App\Models\Article::factory(100)->create();
        \App\Models\Event::factory(100)->create();
        $this->call([
            UserSeeder::class,
            ConditionSeeder::class,
            StackSeeder::class,
        ]);
    }
}
