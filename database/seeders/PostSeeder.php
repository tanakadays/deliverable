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
            [
                'place_name' => "秋名山",
                'genre' => "漫画",
                'title_name' => "イニシャルD",
                'area' => "群馬県",
                'information' => "是非訪れてみてください。",
                'created_at' => new Datetime(),
                'updated_at' => new Datetime(),
                'category_genre_id' => 1,
                'category_title_id' => 1,
                'category_area_id' => 10,
                'user_id' => 1,
            ],
            [
                'place_name' => "飛騨古川駅",
                'genre' => "映画",
                'title_name' => "君の名は。",
                'area' => "栃木県",
                'information' => "君の名はのスポットです。",
                'created_at' => new Datetime(),
                'updated_at' => new Datetime(),
                'category_genre_id' => 3,
                'category_title_id' => 2,
                'category_area_id' => 9,
                'user_id' => 1,
            ],
            [
                'place_name' => "アンパンマンミュージアム",
                'genre' => "アニメ",
                'title_name' => "それいけアンパンマン",
                'area' => "高知県",
                'information' => "やなせたかしさんのふるさとです。",
                'created_at' => new Datetime(),
                'updated_at' => new Datetime(),
                'category_genre_id' => 2,
                'category_title_id' => 3,
                'category_area_id' => 39,
                'user_id' => 1,
            ]
        ]);
    }

}
