<?php

namespace Database\Seeders;

use App\Models\Idea;
use App\Models\Status;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
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

        Idea::factory(30)->create();
    }
}
