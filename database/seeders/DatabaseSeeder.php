<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('views_times')->insert([
            [
                'from' => '00:00',
                'to' => '05:59',
            ],
            [
                'from' => '06:00',
                'to' => '14:59',
            ],
            [
                'from' => '15:00',
                'to' => '20:59',
            ],
            [
                'from' => '21:00',
                'to' => '23:59',
            ],
        ]);

        DB::table('views_pages')->insert([
            ['page' => 'weather'],
            ['page' => 'position'],
            ['page' => 'statistics'],
        ]);
    }
}
