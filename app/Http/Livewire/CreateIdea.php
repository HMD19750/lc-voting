<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAuthRedirects;
use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;
use App\Models\Category;
use Symfony\Component\HttpFoundation\Response;

class CreateIdea extends Component
{
    use WithAuthRedirects;

    public $title;
    public $category = 1;
    public $description = "";

    protected $rules = [
        'title' => 'required|min:4',
        'category' => 'required|integer|exists:categories,id',
        'description' => 'required|min:4'
    ];

    public function render()
    {
        return view('livewire.create-idea', [
            'categories' => Category::all()
        ]);
    }

    public function createIdea()
    {

        if (auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();

        $idea = Idea::create([
            'user_id' => auth()->id(),
            'category_id' => $this->category,
            'status_id' => 1,
            'title' => $this->title,
            'description' => $this->description
        ]);

        Vote::create([
            'user_id' => auth()->id(),
            'idea_id' => $idea->id
        ]);

        $this->emit('ideaWasCreated', 'The idea was created successfully!');

        // $this->reset();

        return redirect()->route('idea.index');
    }
}
