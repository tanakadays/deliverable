<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('posts')->insert([
            'place_name' => "秋名山",
            'genre' => "漫画",
            'title_name' => "initialD",
            'area' => "群馬県",
            'information' => "是非訪れてみてください。",
            'created_at' => new Datetime(),
            'updated_at' => new Datetime(),
            'category_genre_id' => 1,
            'category_title_id' => 1,
            'category_area_id' => 1,
            'user_id' => 1,
            
        ]);
        
        DB::table('posts')->insert([
            'place_name' => "いろは坂",
            'genre' => "漫画",
            'title_name' => "initialD",
            'area' => "栃木県",
            'information' => "是非行ってみてください",
            'category_genre_id' => 1,
            'category_title_id' => 1,
            'category_area_id' => 1,
            'user_id' => 1,
            
        ]);
    }
}
