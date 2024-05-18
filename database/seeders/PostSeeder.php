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
            'prace_name' => "毛利探偵事務所",
            'genre' => "漫画",
            'title_name' => "名探偵コナン",
            'area' => "東京都",
            'information' => "名探偵コナンに登場する毛利探偵事務所の所在地です。是非訪れてみてください。",
            'created_at' => new Datetime(),
            'updated_at' => new Datetime(),
            
        ]);
    }
}
