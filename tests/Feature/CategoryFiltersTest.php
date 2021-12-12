<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use Livewire\Livewire;
use App\Models\Category;
use App\Http\Livewire\IdeasIndex;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryFiltersTest extends TestCase
{
    use RefreshDatabase;

    public function test_selecting_a_category_filter_correctly()
    {
        $user = User::factory()->create();

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
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        $ideaThree = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryTwo->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('category', 'category1')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() == 2
                    && $ideas->first()->category->name == 'category1';
            });

        Livewire::test(IdeasIndex::class)
            ->set('category', 'category2')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() == 1
                    && $ideas->first()->category->name == 'category2';
            });
    }

    public function test_the_category_filter_string_filters_correctly1()
    {
        $user = User::factory()->create();

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
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        $ideaThree = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryTwo->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        Livewire::withQueryParams(['category' => 'category1'])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() == 2
                    && $ideas->first()->category->name == 'category1';
            });
    }

    public function test_the_category_filter_string_and_status_filter_string_filters_correctly()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $categoryTwo = Category::factory()->create(['name' => 'category2']);

        $statusImplemented = Status::factory()->create(['name' => 'Implemented']);
        $statusClosed = Status::factory()->create(['name' => 'Closed']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        $ideaThree = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryTwo->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        $ideaFour = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryTwo->id,
            'status_id' => $statusClosed->id,
            'description' => "Description of the first idea."
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('category', 'category2')
            ->set('status', 'Closed')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() == 1
                    && $ideas->first()->category->name == 'category2'
                    && $ideas->first()->status->name == 'Closed';
            });
    }

    public function test_query_string_with_the_category_filter_string_and_status_filter_string_filters_correctly()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $categoryTwo = Category::factory()->create(['name' => 'category2']);

        $statusImplemented = Status::factory()->create(['name' => 'Implemented']);
        $statusClosed = Status::factory()->create(['name' => 'Closed']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        $ideaThree = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryTwo->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        $ideaFour = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryTwo->id,
            'status_id' => $statusClosed->id,
            'description' => "Description of the first idea."
        ]);

        Livewire::withQueryParams(['category' => 'category2', 'status' => 'Closed'])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() == 1
                    && $ideas->first()->category->name == 'category2'
                    && $ideas->first()->status->name == 'Closed';
            });
    }

    public function test_selecting_without_a_category_filter_correctly()
    {
        $user = User::factory()->create();

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
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        $ideaThree = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryTwo->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the third idea."
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('category', 'category1')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() == 2
                    && $ideas->first()->category->name == 'category1';
            });

        Livewire::test(IdeasIndex::class)
            ->set('category', 'All categories')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() == 3;
            });
    }
}
