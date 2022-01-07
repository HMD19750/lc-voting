<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Response;
use App\Notifications\CommentAdded;
use Illuminate\Support\Facades\Mail;
use App\Mail\IdeaStatusUpdatedMailable;


class SetStatus extends Component
{
    public $idea;
    public $status;
    public $comment = "";
    public $notifyAllVoters;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->status = $this->idea->status_id;
    }

    public function render()
    {
        return view('livewire.set-status');
    }

    public function setStatus()
    {

        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        if ($this->idea->status_id == $this->status) {
            $this->emit('statusWasUpdatedError', 'The status did not change!');
            return;
        }

        $this->idea->status_id = $this->status;
        $this->idea->save();

        if ($this->notifyAllVoters) {
            $this->notifyAllVoters();
        }

        $newComment = Comment::create([
            'user_id' => auth()->id(),
            'idea_id' => $this->idea->id,
            'status_id' => $this->status,
            'body' => $this->comment ? $this->comment : "No comment was added.",
            'is_status_update' => true
        ]);

        $newComment['body'] = "The status of your idea has been changed to " . $this->idea->status->name;
        $this->idea->user->notify(new CommentAdded($newComment));

        $this->emit('statusWasUpdated', 'The status has been updated!');
    }

    public function notifyAllVoters()
    {
        $this->idea->votes()
            ->select('name', 'email')
            ->chunk(100, function ($voters) {
                foreach ($voters as $user) {
                    Mail::to($user)
                        ->queue(new IdeaStatusUpdatedMailable($this->idea));
                }
            });
    }
}
