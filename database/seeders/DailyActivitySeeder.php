<?php

namespace Database\Seeders;

use App\Models\DailyActivity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DailyActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = ['BENCH PRESS', 'SQUATS', 'DEADLIFT', 'MILITARY PRESS', 'BICEP CURL', 'CARDIO'];

        foreach ($rows as $i => $row) {
            DailyActivity::create([
                    'name' => $row,
                    'position' => $i + 1
                ]);
        }
    }
}
