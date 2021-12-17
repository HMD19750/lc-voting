<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowIdeasTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_of_ideas_shows_on_main_page()
    {

        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $categoryTwo = Category::factory()->create(['name' => 'category2']);
        $statusOne = Status::factory()->create(['name' => 'Open']);
        $statusTwo = Status::factory()->create(['name' => 'Closed']);

        $idea1 = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOne->id,
            'description' => "Description of the first idea."
        ]);

        $idea2 = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My second title',
            'category_id' => $categoryTwo->id,
            'status_id' => $statusTwo->id,
            'description' => "Description of the second idea."
        ]);

        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();
        $response->assertSee($idea1->title);
        $response->assertSee($categoryOne->name);
        $response->assertSee($statusOne->name);
        $response->assertSee($idea1->description);
        $response->assertSee($idea2->title);
        $response->assertSee($categoryTwo->name);
        $response->assertSee($idea2->description);
        $response->assertSee($statusTwo->name);
    }

    public function test_single_idea_shows_on_the_show_page()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $categoryTwo = Category::factory()->create(['name' => 'category2']);
        $statusOne = Status::factory()->create(['name' => 'Open']);

        $idea1 = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOne->id,
            'description' => "Description of the first idea."
        ]);

        $idea2 = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My second title',
            'category_id' => $categoryTwo->id,
            'status_id' => $statusOne->id,
            'description' => "Description of the second idea."
        ]);

        $response = $this->get(route('idea.show', $idea1));

        $response->assertSuccessful();
        $response->assertSee($idea1->title);
        $response->assertSee($idea1->description);
        $response->assertSee($categoryOne->name);
        $response->assertSee($statusOne->name);
        $response->assertDontSee($idea2->title);
        $response->assertDontSee($idea2->description);
        // $response->assertDontSee($categoryTwo->name);
    }

    public function test_ideas_pagination_works()
    {
        $user = User::factory()->create();
        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $statusOne = Status::factory()->create(['name' => 'Open']);

        Idea::factory(Idea::PAGINATION_COUNT + 1)->create(
            [
                'user_id' => $user->id,
                'category_id' => $categoryOne->id,
                'status_id' => $statusOne->id
            ]
        );

        $ideaOne = Idea::find(1);
        $ideaOne->title = "My first idea";
        $ideaOne->save();

        $ideaLast = Idea::find(Idea::PAGINATION_COUNT + 1);
        $ideaLast->title = "My last idea";
        $ideaLast->save();

        $response = $this->get(route('idea.index', $ideaOne));
        $response->assertDontSee($ideaOne->title);
        $response->assertSee($ideaLast->title);

        $response = $this->get('/?page=2');
        $response->assertSee($ideaOne->title);
        $response->assertDontSee($ideaLast->title);
    }

    public function test_same_title_different_slugs()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $statusOne = Status::factory()->create(['name' => 'Open']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOne->id,
            'description' => 'Description for my first idea',
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOne->id,
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
