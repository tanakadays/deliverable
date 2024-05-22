<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class CategoryAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_areas')->insert([
            'name'=>"群馬県",
        ]);
        
        DB::table('category_areas')->insert([
            'name'=>"栃木県",
        ]);
        
        DB::table('category_areas')->insert([
            'name'=>"東京都",
        ]);
    }
}
