<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $users = User::all();

        if ($users->count() === 0) {
            $this->command->warn('No users found. Please seed the users table first.');
            return;
        }

        foreach ($users as $user) {
            // Create between 3 and 7 tasks per user
            $tasksCount = rand(3, 7);

            for ($i = 0; $i < $tasksCount; $i++) {
                Task::create([
                    'title' => $faker->sentence(4),
                    'description' => $faker->paragraph(),
                    'status' => $faker->randomElement(['pending', 'completed']),
                    'priority' => $faker->randomElement(['low', 'medium', 'high']),
                    // Use optional() helper to safely handle null due_date
                    'due_date' => optional($faker->optional()->dateTimeBetween('now', '+1 month'))->format('Y-m-d'),
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}