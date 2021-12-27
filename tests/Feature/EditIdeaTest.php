<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use Livewire\Livewire;
use App\Models\Category;
use Illuminate\Http\Response;
use App\Http\Livewire\EditIdea;
use App\Http\Livewire\IdeaShow;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditIdeaTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_edit_idea_livewire_component_when_user_has_authorization()
    {

        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusOne = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOne->id,
            'description' => "Description of the first idea."
        ]);

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertSeeLivewire('edit-idea');
    }

    public function test_does_not_show_edit_idea_livewire_component_when_user_does_not_have_authorization()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusOne = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $userB->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOne->id,
            'description' => "Description of the first idea."
        ]);

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertDontSeeLivewire('edit-idea');
    }

    public function test_edit_idea_form_validation_works()
    {

        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusOne = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOne->id,
            'description' => "Description of the first idea."
        ]);

        Livewire::actingAs($user)
            ->test(EditIdea::class, [
                'idea' => $idea
            ])
            ->set('title', '')
            ->set('category', '')
            ->set('description', '')
            ->call('updateIdea')
            ->assertHasErrors(['title', 'category', 'description'])
            ->assertSee("The title field is required");
    }

    public function test_editing_an_idea_works_when_user_has_authorization()
    {

        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $categoryTwo = Category::factory()->create(['name' => 'category2']);

        $statusOne = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOne->id,
            'description' => "Description of the first idea."
        ]);

        Livewire::actingAs($user)
            ->test(EditIdea::class, [
                'idea' => $idea
            ])
            ->set('title', 'My edited idea')
            ->set('category', $categoryTwo->id)
            ->set('description', 'The description of this idea')
            ->call('updateIdea')
            ->assertEmitted('ideaWasUpdated');

        $this->AssertDatabaseHas('ideas', [
            'title' => 'My edited idea',
            'description' => 'The description of this idea',
            'category_id' => $categoryTwo->id
        ]);
    }

    public function test_editing_an_idea_does_not_work_when_user_has_no_authorization_because_other_user_created_idea()
    {

        $user = User::factory()->create();
        $userB = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusOne = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOne->id,
            'description' => "Description of the first idea."
        ]);

        Livewire::actingAs($userB)
            ->test(EditIdea::class, [
                'idea' => $idea
            ])
            ->set('title', 'My edited idea')
            ->set('category', $categoryOne->id)
            ->set('description', 'The description of this idea')
            ->call('updateIdea')
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_editing_an_idea_does_not_work_when_user_has_no_authorization_because_not_logged_in()
    {

        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusOne = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOne->id,
            'description' => "Description of the first idea."
        ]);

        Livewire::test(EditIdea::class, [
            'idea' => $idea
        ])
            ->set('title', 'My edited idea')
            ->set('category', $categoryOne->id)
            ->set('description', 'The description of this idea')
            ->call('updateIdea')
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_editing_an_idea_does_not_work_when_user_has_no_authorization_because_idea_is_older_then_1_hour()
    {

        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusOne = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOne->id,
            'description' => "Description of the first idea.",
            'created_at' => now()->subHours(2)
        ]);

        Livewire::actingAs($user)
            ->test(EditIdea::class, [
                'idea' => $idea
            ])
            ->set('title', 'My edited idea')
            ->set('category', $categoryOne->id)
            ->set('description', 'The description of this idea')
            ->call('updateIdea')
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_editing_an_idea_shows_in_menu_when_user_has_authorization()
    {

        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusOne = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOne->id,
            'description' => "Description of the first idea."
        ]);

        Livewire::actingAs($user)
            ->test(IdeaShow::class, [
                'idea' => $idea,
                'votesCount' => 22
            ])
            ->assertSee('Edit Idea');
    }

    public function test_editing_an_idea_does_not_show_in_menu_when_user_has_no_authorization()
    {

        $user = User::factory()->create();
        $userB = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusOne = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOne->id,
            'description' => "Description of the first idea."
        ]);

        Livewire::actingAs($userB)
            ->test(IdeaShow::class, [
                'idea' => $idea,
                'votesCount' => 22
            ])
            ->assertDontSee('Edit Idea');
    }
}
