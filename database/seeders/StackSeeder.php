<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stacks')->insert([
            [
                'stack' => 'Java',
            ],
            [
                'stack' => 'PHP',
            ],
            [
                'stack' => 'JavaScript',
            ],
            [
                'stack' => 'Python',
            ],
            [
                'stack' => 'C/C++',
            ],
            [
                'stack' => 'C#',
            ],
            [
                'stack' => 'Ruby',
            ],
            [
                'stack' => 'Go',
            ],
            [
                'stack' => 'Swift',
            ],
            [
                'stack' => 'kotlin',
            ],
            [
                'stack' => 'objective-c',
            ],
            [
                'stack' => 'Scala',
            ],
            [
                'stack' => 'R',
            ],
            [
                'stack' => 'SQL',
            ],
            [
                'stack' => 'HTML・CSS',
            ],
            [
                'stack' => 'Laravel',
            ],
            [
                'stack' => 'React',
            ],
            [
                'stack' => 'vue',
            ],
            [
                'stack' => 'Docker',
            ],
            [
                'stack' => 'AWS',
            ],
            [
                'stack' => 'Microsoft Azure',
            ],
            [
                'stack' => 'Google Cloud Platform',
            ],

        ]);
    }
}
