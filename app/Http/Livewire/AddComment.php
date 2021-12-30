<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Response;
use App\Notifications\CommentAdded;
use App\Http\Livewire\Traits\WithAuthRedirects;

class AddComment extends Component
{
    use WithAuthRedirects;

    public $idea;
    public $comment;

    protected $rules = [
        'comment' => 'required|min:4'
    ];

    public function addComment()
    {

        if (auth()->guest()) {
            $this->redirectToLogin();
        }

        $this->validate();

        $newComment = Comment::create([
            'user_id' => auth()->id(),
            'idea_id' => $this->idea->id,
            'status_id' => 1,
            'body' => $this->comment
        ]);

        $this->reset('comment');

        $this->idea->user->notify(new CommentAdded($newComment));

        $this->emit('commentWasAdded', 'The new comment has been added!');
    }

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }



    public function render()
    {
        return view('livewire.add-comment');
    }
}
