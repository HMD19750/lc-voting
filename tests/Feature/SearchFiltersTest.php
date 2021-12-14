<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use Livewire\Livewire;
use App\Models\Category;
use App\Http\Livewire\IdeasIndex;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchFiltersTest extends TestCase
{
    use RefreshDatabase;

    public function test_searching_doesn_not_work_with_less_than_3_characters()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusImplemented = Status::factory()->create(['id' => '4', 'name' => 'Implemented']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My second title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the second idea."
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My third title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the third idea."
        ]);


        Livewire::test(IdeasIndex::class)
            ->set('search', 'Se')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() == 3;
            });
    }

    public function test_searching_works_when_more_than_3_characters()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusImplemented = Status::factory()->create(['id' => '4', 'name' => 'Implemented']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My second title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the second idea."
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My third title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the third idea."
        ]);


        Livewire::test(IdeasIndex::class)
            ->set('search', 'Second')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() == 1
                    && $ideas->first()->title == "My second title";
            });
    }

    public function test_search_works_in_combination_with_category_filter()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();
        $userC = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $categoryTwo = Category::factory()->create(['name' => 'category2']);

        $statusImplemented = Status::factory()->create(['id' => '4', 'name' => 'Implemented']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My second title',
            'category_id' => $categoryTwo->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the second thought."
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My third title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the third idea."
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('search', 'idea')
            ->set('category', 'category1')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() == 2;
            });

        Livewire::test(IdeasIndex::class)
            ->set('search', 'idea')
            ->set('category', 'category2')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() == 0;
            });
    }
}
