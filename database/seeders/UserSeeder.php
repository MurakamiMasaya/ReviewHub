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
                'password' => Hash::make('password123'),
                'admin_flg' => 1,
            ],
        ]);
    }
}
