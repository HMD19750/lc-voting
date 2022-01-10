<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Response;

class EditComment extends Component
{
    public Comment $comment;
    public $body = "";

    protected $listeners = ['setEditComment'];
    protected $rules = [
        'body' => 'required|min:4'
    ];

    public function setEditComment($commentId)
    {
        $this->comment = Comment::findOrFail($commentId);
        $this->body = $this->comment->body;

        $this->emit('editCommentWasSet');
    }

    public function updateComment()
    {
        if (auth()->guest() || auth()->user()->cannot('update', $this->comment)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();

        $this->comment->update([
            'body' => $this->body
        ]);

        $this->emit('commentWasUpdated', 'The comment was updated successfully!');
    }


    public function render()
    {
        return view('livewire.edit-comment');
    }
}
