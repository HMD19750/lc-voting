<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use Livewire\Livewire;
use App\Models\Category;
use App\Http\Livewire\SetStatus;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminSetStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_page_contains_set_status_livewire_component_when_userIs_admin()
    {
        $user = User::factory()->create(
            ['email' => 'hmd19570@gmail.com']
        );

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusImplemented = Status::factory()->create(['id' => '4', 'name' => 'Implemented']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertSeeLivewire('set-status');
    }

    public function test_show_page_does_not_contain_set_status_livewire_component_when_user_is_not_Is_admin()
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

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertDontSeeLivewire('set-status');
    }

    public function test_initial_status_is_set_correctly()
    {
        $user = User::factory()->create(
            ['email' => 'hmd19570@gmail.com']
        );

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusImplemented = Status::factory()->create(['id' => '4', 'name' => 'Implemented']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        Livewire::actingAs($user)
            ->test(SetStatus::class, ['idea' => $idea])
            ->assertSet('status', $statusImplemented->id);
    }

    public function test_can_set_status_correctly()
    {
        $user = User::factory()->create(
            ['email' => 'hmd19570@gmail.com']
        );

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusImplemented = Status::factory()->create(['id' => '4', 'name' => 'Implemented']);
        $statusConsidering = Status::factory()->create(['id' => '2', 'name' => 'Considering']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        Livewire::actingAs($user)
            ->test(SetStatus::class, ['idea' => $idea])
            ->set('status', $statusConsidering->id)
            ->call('setStatus')
            ->assertEmitted('statusWasUpdated');

        $this->assertDatabaseHas('ideas', [
            'id' => $idea->id,
            'status_id' => $statusConsidering->id
        ]);
    }
}
