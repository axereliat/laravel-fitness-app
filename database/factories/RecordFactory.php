<?php

namespace Database\Factories;

use App\Models\DailyActivity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Record>
 */
class RecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'daily_activity_id' => DailyActivity::all()->random()->id,
            'sets' => rand(1, 10),
            'reps' => rand(1, 30),
            'user_id' => User::all()->random()->id,
        ];
    }
}
