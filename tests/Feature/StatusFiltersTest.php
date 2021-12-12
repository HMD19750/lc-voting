<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use Livewire\Livewire;
use App\Models\Category;
use App\Http\Livewire\StatusFilters;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusFiltersTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_contains_status_filters_livewire_component()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => "Description of the first idea."
        ]);

        $this->get(route('idea.index'))
            ->assertSeeLivewire('status-filters');
    }

    public function test_show_page_contains_status_filters_livewire_component()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => "Description of the first idea."
        ]);

        $this->get(route('idea.show', $idea))
            ->assertSeeLivewire('status-filters');
    }

    public function test_index_page_shows_correct_status_count()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusImplemented = Status::factory()->create(['id' => '4', 'name' => 'Implemented']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        Livewire::test(StatusFilters::class)
            ->assertSee('All Ideas (2)')
            ->assertSee('Implemented (2)');
    }


    public function test_show_page_should_not_show_selected_status()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusImplemented = Status::factory()->create(['id' => '4', 'name' => 'Implemented']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        $response = $this->get(route('idea.show', $idea));

        $response->assertDontSee('border-blue text-gray-900', false);
    }

    public function test_index_page_should_show_selected_status()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusImplemented = Status::factory()->create(['id' => '4', 'name' => 'Implemented']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        $response = $this->get(route('idea.index'));

        $response->assertSee('border-blue text-gray-900', false);
    }
}
