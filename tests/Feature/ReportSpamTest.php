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
use App\Http\Livewire\IdeaIndex;
use App\Http\Livewire\DeleteIdea;
use App\Http\Livewire\MarkIdeaAsSpam;
use App\Http\Livewire\MarkIdeaAsNotSpam;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportSpamTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_mark_as_spam_livewire_component_when_user_has_authorization()
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
            ->assertSeeLivewire('mark-idea-as-spam');
    }

    public function test_shows_mark_as_not_spam_livewire_component_when_user_has_authorization()
    {

        $user = User::factory()->create([
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

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertSeeLivewire('mark-idea-as-not-spam');
    }

    // public function test_does_not_show_mark_idea_as_spam_livewire_component_when_user_is_not_logged_in()
    // {
    //     $userB = User::factory()->create();

    //     $categoryOne = Category::factory()->create(['name' => 'category1']);

    //     $statusOne = Status::factory()->create(['name' => 'Open']);

    //     $idea = Idea::factory()->create([
    //         'user_id' => $userB->id,
    //         'title' => 'My first title',
    //         'category_id' => $categoryOne->id,
    //         'status_id' => $statusOne->id,
    //         'description' => "Description of the first idea."
    //     ]);

    //     $this->get(route('idea.show', $idea))
    //         ->assertDontSeeLivewire('mark-idea-as-spam');
    // }


    public function test_marking_an_idea_as_spam_works_when_user_has_authorization()
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
            ->test(MarkIdeaAsSpam::class, [
                'idea' => $idea
            ])
            ->call('markIdeaAsSpam')
            ->assertEmitted('ideaWasMarkedAsSpam');

        $this->assertEquals(1, Idea::first()->spam_reports);
    }

    public function test_marking_an_idea_as_not_spam_works_when_user_has_authorization()
    {

        $user = User::factory()->create([
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
            'description' => "Description of the first idea.",
            'spam_reports' => 1
        ]);

        Livewire::actingAs($user)
            ->test(MarkIdeaAsNotSpam::class, [
                'idea' => $idea
            ])
            ->call('markIdeaAsNotSpam')
            ->assertEmitted('ideaWasMarkedAsNotSpam');

        $this->assertEquals(0, Idea::first()->spam_reports);
    }

    public function test_marking_an_idea_as_spam_does_not_work_when_user_has_no_authorization()
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


        Livewire::test(MarkIdeaAsSpam::class, [
            'idea' => $idea
        ])
            ->call('markIdeaAsSpam')
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertEquals(0, Idea::first()->spam_reports);
    }

    public function test_marking_an_idea_as_not_spam_does_not_work_when_user_has_no_authorization()
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
            'spam_reports' => 1
        ]);


        Livewire::test(MarkIdeaAsNotSpam::class, [
            'idea' => $idea
        ])
            ->call('markIdeaAsNotSpam')
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertEquals(1, Idea::first()->spam_reports);
    }

    public function test_marking_an_idea_as_spam_shows_in_menu_when_user_is_logged_in()
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
            ->test(MarkIdeaAsSpam::class, [
                'idea' => $idea
            ])
            ->assertSee('Mark as spam');
    }

    public function test_marking_an_idea_as_not_spam_shows_in_menu_when_user_is_admin()
    {

        $user = User::factory()->create(
            [
                'email' => 'hmd19570@gmail.com'
            ]
        );

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusOne = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first title',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOne->id,
            'description' => "Description of the first idea.",
            'spam_reports' => 1
        ]);

        Livewire::actingAs($user)
            ->test(MarkIdeaAsNotSpam::class, [
                'idea' => $idea
            ])
            ->assertSee('Reset spam counter');
    }

    public function test_marking_an_idea_as_spam_shows_in_menu_when_user_is_admin()
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
            ->test(MarkIdeaAsSpam::class, [
                'idea' => $idea
            ])
            ->assertSee('Mark as spam');
    }

    // public function test_marking_an_idea_as_spam_does_not_show_in_menu_when_user_has_no_authorization()
    // {

    //     $user = User::factory()->create();

    //     $categoryOne = Category::factory()->create(['name' => 'category1']);

    //     $statusOne = Status::factory()->create(['name' => 'Open']);

    //     $idea = Idea::factory()->create([
    //         'user_id' => $user->id,
    //         'title' => 'My first title',
    //         'category_id' => $categoryOne->id,
    //         'status_id' => $statusOne->id,
    //         'description' => "Description of the first idea.",
    //         'spam_reports' => 2
    //     ]);

    //     Livewire::test(MarkIdeaAsSpam::class, [
    //         'idea' => $idea
    //     ])
    //         ->assertDontSee('Mark as spam');
    // }

    // public function test_marking_an_idea_as_not_spam_does_not_show_in_menu_when_user_is_not_admin()
    // {

    //     $user = User::factory()->create();

    //     $categoryOne = Category::factory()->create(['name' => 'category1']);

    //     $statusOne = Status::factory()->create(['name' => 'Open']);

    //     $idea = Idea::factory()->create([
    //         'user_id' => $user->id,
    //         'title' => 'My first title',
    //         'category_id' => $categoryOne->id,
    //         'status_id' => $statusOne->id,
    //         'description' => "Description of the first idea.",
    //         'spam_reports' => 2
    //     ]);

    //     Livewire::test(MarkIdeaAsNotSpam::class, [
    //         'idea' => $idea
    //     ])
    //         ->assertDontSee('Reset spam counter');
    // }

    public function test_spam_report_count_shows_on_index_page_when_user_is_admin()
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
            'description' => "Description of the first idea.",
            'spam_reports' => 22
        ]);

        Livewire::actingAs($admin)
            ->test(IdeaIndex::class, [
                'idea' => $idea,
                'votesCount' => 4
            ])
            ->assertSee('Spam reports: 22');
    }

    public function test_spam_report_count_shows_on_show_page_when_user_is_admin()
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
            'description' => "Description of the first idea.",
            'spam_reports' => 22
        ]);

        Livewire::actingAs($admin)
            ->test(IdeaShow::class, [
                'idea' => $idea,
                'votesCount' => 4
            ])
            ->assertSee('Spam reports: 22');
    }
}
