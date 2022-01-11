<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use App\Http\Livewire\Traits\WithAuthRedirects;

class IdeaComment extends Component
{
    use WithAuthRedirects;

    public $comment;
    public $ideaUserId;
    public $hasLiked;
    public $likesCount;

    protected $listeners = [
        'commentWasUpdated',
        'commentWasMarkedAsSpam',
        'commentWasMarkedAsNotSpam'
    ];

    public function mount(Comment $comment, $ideaUserId)
    {
        $this->comment = $comment;
        $this->ideaUserId = $ideaUserId;
        $this->likesCount = $comment->likes()->count();
        $this->hasLiked = $comment->liked_by_user;
    }

    public function commentWasUpdated()
    {
        $this->comment->refresh();
    }

    public function commentWasMarkedAsSpam()
    {
        $this->comment->refresh();
    }

    public function commentWasMarkedAsNotSpam()
    {
        $this->comment->refresh();
    }


    public function render()
    {
        return view('livewire.idea-comment');
    }

    public function like()
    {
        if (auth()->guest()) {
            return $this->redirectToLogin();
        }

        if ($this->hasLiked) {
            $this->comment->removeLike(auth()->user());
            $this->likesCount--;
            $this->hasLiked = false;
        } else {
            $this->comment->like(auth()->user());
            $this->likesCount++;
            $this->hasLiked = true;
        }
    }
}
