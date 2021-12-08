<?php

namespace Database\Seeders;

use App\Models\Idea;
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

        Idea::factory(30)->create();
    }
}
