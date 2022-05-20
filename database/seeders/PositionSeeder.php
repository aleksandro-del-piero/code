<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'Police'],
            ['name' => 'Security'],
            ['name' => 'Driver'],
            ['name' => 'Designer'],
        ];

        DB::table('positions')->insert($items);
    }
}
