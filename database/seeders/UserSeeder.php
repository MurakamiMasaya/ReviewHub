<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'birthday' => '2022-01-11',
                'gender' => 1,
                'username' => 'このサイトの管理者',
                'email' => 'admin@admin.com',
                'phone' => '00099999999',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'admin_flg' => 1,
                'created_at' => '2022-05-25 00:00:10',
                'updated_at' => '2022-05-25 00:00:10'
            ],
        ]);
    }
}
