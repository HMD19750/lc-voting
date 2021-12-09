<?php

namespace Database\Seeders;

use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Hubert van Dongen',
            'email' => 'hmd@solcon.nl',
            'password' => Hash::make('Penang98')
        ]);
        User::factory(19)->create();

        Category::factory()->create(['name' => 'PHP']);
        Category::factory()->create(['name' => 'Javascript']);
        Category::factory()->create(['name' => 'PHPUnit']);
        Category::factory()->create(['name' => 'Laravel']);
        Category::factory()->create(['name' => 'Vue']);
        Category::factory()->create(['name' => 'Tailwind']);

        Status::factory()->create(['name' => 'Open']);
        Status::factory()->create(['name' => 'Considering']);
        Status::factory()->create(['name' => 'In Progress']);
        Status::factory()->create(['name' => 'Implemented']);
        Status::factory()->create(['name' => 'Closed']);

        Idea::factory(100)->create();

        // Generate unique votes

        foreach (range(1, 20) as $user_id) {
            foreach (range(1, 100) as $idea_id) {
                if ($idea_id % 2 == 0) {
                    Vote::factory()->create([
                        'user_id' => $user_id,
                        'idea_id' => $idea_id
                    ]);
                }
            };
        };
    }
}
