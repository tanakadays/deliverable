<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                'name' => "tanaka",
                'email' => "tanaka@gmail.com",
                'password' => "$2y$10$/Jz.8EQ1iDcP9WQej3rwz.UwU1UzIgsVIsi6T5XJBgjdoR236pz9C",
            ]);
    }
}
