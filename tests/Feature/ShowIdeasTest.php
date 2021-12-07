<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowIdeasTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_of_ideas_shows_on_main_page()
    {

        $idea1 = Idea::factory()->create([
            'title' => 'My first title',
            'description' => "Description of the first idea."
        ]);

        $idea2 = Idea::factory()->create([
            'title' => 'My second title',
            'description' => "Description of the second idea."
        ]);

        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();
        $response->assertSee($idea1->title);
        $response->assertSee($idea1->description);
        $response->assertSee($idea2->title);
        $response->assertSee($idea2->description);
    }

    public function test_single_idea_shows_on_the_show_page()
    {

        $idea1 = Idea::factory()->create([
            'title' => 'My first title',
            'description' => "Description of the first idea."
        ]);

        $idea2 = Idea::factory()->create([
            'title' => 'My second title',
            'description' => "Description of the second idea."
        ]);

        $response = $this->get(route('idea.show', $idea1));

        $response->assertSuccessful();
        $response->assertSee($idea1->title);
        $response->assertSee($idea1->description);
        $response->assertDontSee($idea2->title);
        $response->assertDontSee($idea2->description);
    }

    public function test_ideas_pagination_works()
    {
        Idea::factory(Idea::PAGINATION_COUNT + 1)->create();

        $ideaOne = Idea::find(1);
        $ideaOne->title = "My first idea";
        $ideaOne->save();

        $ideaLast = Idea::find(Idea::PAGINATION_COUNT + 1);
        $ideaLast->title = "My last idea";
        $ideaLast->save();

        $response = $this->get(route('idea.index', $ideaOne));
        $response->assertSee($ideaOne->title);
        $response->assertDontSee($ideaLast->title);

        $response = $this->get('/?page=2');
        $response->assertDontSee($ideaOne->title);
        $response->assertSee($ideaLast->title);
    }

    public function test_same_title_different_slugs()
    {
        $ideaOne = Idea::factory()->create([
            'title' => 'My First Idea',
            'description' => 'Description for my first idea',
        ]);

        $ideaTwo = Idea::factory()->create([
            'title' => 'My First Idea',
            'description' => 'Another Description for my first idea',
        ]);

        $response = $this->get(route('idea.show', $ideaOne));

        $response->assertSuccessful();
        $this->assertTrue(request()->path() === 'ideas/my-first-idea');

        $response = $this->get(route('idea.show', $ideaTwo));

        $response->assertSuccessful();
        $this->assertTrue(request()->path() === 'ideas/my-first-idea-2');
    }
}
