<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conditions')->insert([
            [
                'condition' => '実務未経験',
            ],
            [
                'condition' => '経験浅め(1~3年)',
            ],
            [
                'condition' => '新卒・第二新卒',
            ],
            [
                'condition' => '中途',
            ],
            [
                'condition' => 'フルリモート',
            ],
            [
                'condition' => '東京勤務',
            ],
            [
                'condition' => '関西勤務',
            ],
            [
                'condition' => '正社員',
            ],
            [
                'condition' => '業務委託',
            ],
            [
                'condition' => '副業',
            ],

        ]);
    }
}
