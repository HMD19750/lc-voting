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

class OtherFiltersTest extends TestCase
{
    use RefreshDatabase;

    public function test_top_voted_filter_works()
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
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        Vote::factory()->create([
            'idea_id' => $ideaOne->id,
            'user_id' => $user->id
        ]);

        Vote::factory()->create([
            'idea_id' => $ideaOne->id,
            'user_id' => $userB->id
        ]);

        Vote::factory()->create([
            'idea_id' => $ideaTwo->id,
            'user_id' => $userC->id
        ]);


        Livewire::test(IdeasIndex::class)
            ->set('filter', 'Top Voted')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() == 2
                    && $ideas->first()->votes()->count() == 2
                    && $ideas->last()->votes()->count() == 1;
            });
    }

    public function test_my_ideas_filter_works_correctly_when_user_logs_in()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();


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
            'description' => "Description of the first idea."
        ]);

        $ideaThree = Idea::factory()->create([
            'user_id' => $userB->id,
            'title' => 'My third title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);


        Livewire::actingAs($user)
            ->test(IdeasIndex::class)
            ->set('filter', 'My Ideas')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() == 2
                    && $ideas->first()->title = "My second title"
                    && $ideas->last()->title = "My first title";
            });
    }

    public function test_my_ideas_filter_pageRedirects_when_user_not_logged_in()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();


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
            'description' => "Description of the first idea."
        ]);

        $ideaThree = Idea::factory()->create([
            'user_id' => $userB->id,
            'title' => 'My third title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);


        Livewire::test(IdeasIndex::class)
            ->set('filter', 'My Ideas')
            ->assertRedirect(route('login'));
    }

    public function test_my_ideas_filter_works_with_categories_filter()
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
            'title' => 'My second title',
            'category_id' => $categoryTwo->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);

        $ideaThree = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My third title',
            'category_id' => $categoryTwo->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea."
        ]);


        Livewire::actingAs($user)
            ->test(IdeasIndex::class)
            ->set('filter', 'My Ideas')
            ->set('category', 'category2')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() == 2
                    && $ideas->first()->title = "My third title"
                    && $ideas->last()->title = "My second title";
            });
    }



    public function test_spam_filter_works_correctly()
    {
        $user = User::factory()->create([
            'email' => 'hmd19570@gmail.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusImplemented = Status::factory()->create(['id' => '4', 'name' => 'Implemented']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea.",
            'spam_reports' => 0
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My second title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea.",
            'spam_reports' => 33
        ]);

        $ideaThree = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My third title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusImplemented->id,
            'description' => "Description of the first idea.",
            'spam_reports' => 44
        ]);


        Livewire::actingAs($user)
            ->test(IdeasIndex::class)
            ->set('filter', 'Spam Report')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() == 2
                    && $ideas->first()->title = "My third title"
                    && $ideas->last()->title = "My second title";
            });
    }
}
