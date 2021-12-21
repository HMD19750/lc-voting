<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class IdeaComments extends Component
{
    use WithPagination;

    public $idea;

    protected $listeners = ['commentWasAdded'];

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function commentWasAdded()
    {
        $this->idea->refresh();
        $this->gotoPage($this->idea->comments()->paginate()->lastPage());
    }

    public function render()
    {
        return view('livewire.idea-comments', [
            // 'comments' => $this->idea->comments()->orderBy('created_at', 'desc')->get()
            'comments' => Comment::with('user')->where('idea_id', $this->idea->id)->paginate()->withQueryString()

        ]);
    }
}
