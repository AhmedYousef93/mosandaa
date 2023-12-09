<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('days')->insert([
            ['name' => 'Saturday', 'status' => 1],
            ['name' => 'Sunday', 'status' => 1],
            ['name' => 'Monday', 'status' => 1],
            ['name' => 'Tuesday', 'status' => 1],
            ['name' => 'Wednesday', 'status' => 1],
            ['name' => 'Thursday', 'status' => 1],
            ['name' => 'Friday', 'status' => 1],
        ]);


        DB::table('times')->insert([
            ['day_id' => '1', 'time' => 12.20],
            ['day_id' => '2', 'time' => 11.20],
            ['day_id' => '3', 'time' => 10.20],
            ['day_id' => '4', 'time' => 10.20],
            ['day_id' => '5', 'time' => 10.20],
            ['day_id' => '6', 'time' => 10.20],
            ['day_id' => '7', 'time' => 10.20],
        ]);
    }
}
