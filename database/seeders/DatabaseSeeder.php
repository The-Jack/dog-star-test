<?php

namespace Database\Seeders;

use App\Models\Task;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('pass-for-test'),
        ]);

        Task::factory(10)->create([
            'owner' => $user->id,
        ]);

    }
}
