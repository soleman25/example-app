<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class Create extends Component
{
    public $title;
    public $content;

    public function render()
    {
        return view('livewire.create');
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|min:6',
            'content' => 'required|string|max:500',
        ]);

       $post = Post::create([
        'title' =>$this->title,
        'content' =>$this->content,
       ]);

        $this->resetInput();

        $this->emit('postSave', $post);
    }

    private function resetInput()
    {
        $this->title   = '';
        $this->content = '';
    }
}
