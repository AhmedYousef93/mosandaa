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
    }
}
