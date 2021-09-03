<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //分类填充
        DB::table('categories')->insert([
            ['name' => 'PHP'],
            ['name' => 'HTML'],
            ['name' => 'Ajax'],
            ['name' => 'Java'],
            ['name' => 'ASP.net'],
            ['name' => 'GO'],
        ]);
    }
}
