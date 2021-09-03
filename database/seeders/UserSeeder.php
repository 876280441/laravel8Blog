<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //填充用户数据
        DB::table('users')->insert([
            'name' => '111111',
            'email' => '111111'.'@qq.com',
            'password' => Hash::make('111111'),
        ]);
    }
}
