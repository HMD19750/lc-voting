<?php

namespace Tests\Feature\Comments;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use App\Models\Comment;
use App\Models\Category;
use App\Http\Livewire\IdeaComment;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowCommentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_idea_comments_livewire_component_renders()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusImplemented = Status::factory()->create(['id' => '4', 'name' => 'Implemented']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea.",
            'spam_reports' => 0
        ]);

        $commentOne = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'This is my first comment',
        ]);

        $response = $this->get(route('idea.show', $idea));

        $response->assertSeeLivewire('idea-comments');
    }



    public function test_no_comments_shows_appropriate_function()
    {
        $idea = Idea::factory()->create();

        $this->get(route('idea.show', $idea))
            ->assertSee('No comments yet...');
    }

    public function test_list_of_comments_shows_on_idea_page()
    {
        $idea = Idea::factory()->create();

        $commentOne = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'This is my first comment',
        ]);

        $commentTwo = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'This is my second comment',
        ]);

        $response = $this->get(route('idea.show', $idea));

        $response->assertSeeInOrder(['This is my first comment', 'This is my second comment']);
        $response->assertSee('2 comments');
    }

    public function test_comments_count_shows_correctly_on_index_page()
    {
        $idea = Idea::factory()->create();

        $commentOne = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => "First comment"
        ]);
        $commentTwo = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => "Second comment"
        ]);

        $this->get(route('idea.index'))
            ->assertSee('2 comments');
    }

    public function test_op_badge_shows_when_author_of_idea_comments_on_idea()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        $commentOne = Comment::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id,
            'body' => "First comment"
        ]);

        $commentTwo = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => "First comment"
        ]);


        $this->get(route('idea.show', $idea))
            ->assertSee('OP');
    }
}
