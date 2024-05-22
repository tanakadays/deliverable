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
            'name'=>"initialD",
        ]);
        
        DB::table('category_titles')->insert([
            'name'=>"ドラえもん",
        ]);
        
        DB::table('category_titles')->insert([
            'name'=>"サザエさん",
        ]);
    }
}
