<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class Category_genreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_genres')->insert([
            'name' => '漫画',
        ]);
        
        DB::table('category_genres')->insert([
            'name' => 'アニメ',
        ]);
        
        DB::table('category_genres')->insert([
            'name' => '映画',
        ]);
    }
}
