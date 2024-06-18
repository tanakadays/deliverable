<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class CategoryTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_titles')->insert([
        ['name' => "頭文字D"],
        ['name' => "君の名は。"],
        ['name' => "アンパンマン"],
        ['name' => "その他"]
    ]);
    }
}
