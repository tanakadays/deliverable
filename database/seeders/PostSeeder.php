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
                'information' => "秋名スピードスターズの本拠地となる峠です。実際の名前は榛名山というそうです。",
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
            ],
            [
                'place_name' => "江ノ島電鉄鎌倉高校前駅",
                'genre' => "漫画",
                'title_name' => "スラムダンク",
                'area' => "神奈川県",
                'information' => "オープニングにも登場していた駅です",
                'created_at' => new Datetime(),
                'updated_at' => new Datetime(),
                'category_genre_id' => 1,
                'category_title_id' => 5,
                'category_area_id' => 14,
                'user_id' => 1,
            ],
            [
                'place_name' => "あしかがフラワーパーク",
                'genre' => "漫画",
                'title_name' => "鬼滅の刃",
                'area' => "栃木県",
                'information' => "鬼殺隊最終選抜試験が行われたところです",
                'created_at' => new Datetime(),
                'updated_at' => new Datetime(),
                'category_genre_id' => 1,
                'category_title_id' => 5,
                'category_area_id' => 9,
                'user_id' => 1,
            ],
            [
                'place_name' => "日枝神社",
                'genre' => "アニメ",
                'title_name' => "君の名は",
                'area' => "岐阜県",
                'information' => "宮水神社のモデルです",
                'created_at' => new Datetime(),
                'updated_at' => new Datetime(),
                'category_genre_id' => 2,
                'category_title_id' => 2,
                'category_area_id' => 21,
                'user_id' => 1,
            ],
            [
                'place_name' => "立石公園",
                'genre' => "アニメ",
                'title_name' => "君の名は",
                'area' => "長野県",
                'information' => "糸守湖のモデルが見えます",
                'created_at' => new Datetime(),
                'updated_at' => new Datetime(),
                'category_genre_id' => 2,
                'category_title_id' => 2,
                'category_area_id' => 20,
                'user_id' => 1,
            ],
            [
                'place_name' => "須賀神社",
                'genre' => "アニメ",
                'title_name' => "君の名は",
                'area' => "東京都",
                'information' => "ラストシーンに登場していたところです",
                'created_at' => new Datetime(),
                'updated_at' => new Datetime(),
                'category_genre_id' => 2,
                'category_title_id' => 2,
                'category_area_id' => 13,
                'user_id' => 1,
            ],
            [
                'place_name' => "江ノ島電鉄鎌倉高校前駅",
                'genre' => "漫画",
                'title_name' => "スラムダンク",
                'area' => "神奈川県",
                'information' => "オープニングにも登場していた駅です",
                'created_at' => new Datetime(),
                'updated_at' => new Datetime(),
                'category_genre_id' => 1,
                'category_title_id' => 5,
                'category_area_id' => 14,
                'user_id' => 1,
            ],
            [
                'place_name' => "赤城山",
                'genre' => "漫画",
                'title_name' => "イニシャルD",
                'area' => "群馬県",
                'information' => "赤城レッドサンズの本拠地です",
                'created_at' => new Datetime(),
                'updated_at' => new Datetime(),
                'category_genre_id' => 1,
                'category_title_id' => 1,
                'category_area_id' => 10,
                'user_id' => 1,
            ],
            [
                'place_name' => "妙技山",
                'genre' => "漫画",
                'title_name' => "イニシャルD",
                'area' => "群馬県",
                'information' => "妙義ナイトキッズの本拠地です",
                'created_at' => new Datetime(),
                'updated_at' => new Datetime(),
                'category_genre_id' => 1,
                'category_title_id' => 1,
                'category_area_id' => 10,
                'user_id' => 1,
            ],
            [
                'place_name' => "碓氷峠",
                'genre' => "漫画",
                'title_name' => "イニシャルD",
                'area' => "群馬県",
                'information' => "佐藤真子の本拠地です。",
                'created_at' => new Datetime(),
                'updated_at' => new Datetime(),
                'category_genre_id' => 1,
                'category_title_id' => 1,
                'category_area_id' => 10,
                'user_id' => 1,
            ]
            
        ]);
    }

}
