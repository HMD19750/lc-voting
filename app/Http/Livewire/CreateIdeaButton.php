<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAuthRedirects;
use Livewire\Component;
use App\Models\Category;
use Symfony\Component\HttpFoundation\Response;

class CreateIdeaButton extends Component
{
    use WithAuthRedirects;

    public function render()
    {
        return view('livewire.create-idea-button', [
            'categories' => Category::all()
        ]);
    }
}
