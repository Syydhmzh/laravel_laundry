<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Levels;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //insert into
        $levels =
            [
                [
                    'name' => 'Administrator'

                ],
                [
                    'name' => 'Operator'
                ],
                [
                    'name' => 'Leader'
                ]
            ];

        Levels::insert($levels);
    }
}
