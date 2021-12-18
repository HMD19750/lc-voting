<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use Livewire\Livewire;
use App\Models\Category;
use Illuminate\Http\Response;
use App\Http\Livewire\EditIdea;
use App\Http\Livewire\IdeaShow;
use App\Http\Livewire\DeleteIdea;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteIdeaTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_delete_idea_livewire_component_when_user_has_authorization()
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
            ->assertSeeLivewire('delete-idea');
    }

    public function test_does_not_show_delete_idea_livewire_component_when_user_does_not_have_authorization()
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
            ->assertDontSeeLivewire('delete-idea');
    }


    public function test_deleting_an_idea_works_when_user_has_authorization()
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
            ->test(DeleteIdea::class, [
                'idea' => $idea
            ])
            ->call('deleteIdea')
            ->assertRedirect(route('idea.index'));

        $this->assertEquals(0, Idea::count());
    }

    public function test_deleting_an_idea_works_when_user_has_authorization_and_idea_has_votes()
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

        Vote::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);

        Livewire::actingAs($user)
            ->test(DeleteIdea::class, [
                'idea' => $idea
            ])
            ->call('deleteIdea')
            ->assertRedirect(route('idea.index'));

        $this->assertEquals(0, Idea::count());
        $this->assertEquals(0, Vote::count());
    }

    public function test_deleting_an_idea_works_when_user_is_admin_and_idea_has_votes()
    {

        $user = User::factory()->create();
        $admin = User::factory()->create([
            'email' => 'hmd19570@gmail.com'
        ]);

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

        Vote::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);

        Livewire::actingAs($admin)
            ->test(DeleteIdea::class, [
                'idea' => $idea
            ])
            ->call('deleteIdea')
            ->assertRedirect(route('idea.index'));

        $this->assertEquals(0, Idea::count());
        $this->assertEquals(0, Vote::count());
    }


    public function test_deleting_an_idea_shows_in_menu_when_user_has_authorization()
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
            ->assertSee('Delete Idea');
    }

    public function test_deleting_an_idea_shows_in_menu_when_user_is_admin()
    {

        $user = User::factory()->create();
        $admin = User::factory()->create([
            'email' => 'hmd19570@gmail.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusOne = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOne->id,
            'description' => "Description of the first idea."
        ]);

        Livewire::actingAs($admin)
            ->test(IdeaShow::class, [
                'idea' => $idea,
                'votesCount' => 22
            ])
            ->assertSee('Delete Idea');
    }

    public function test_deleting_an_idea_does_not_show_in_menu_when_user_has_no_authorization()
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
            ->assertDontSee('Delete Idea');
    }
}
