<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostUpdate extends Component
{
    public $title;
    public $content;
    public $postId;

    protected $listeners = [
        'getPost' => 'showPost',
    ];
    public function render()
    {
        return view('livewire.post-update');
    }

    public function showPost($post)
    {
        $this->title = $post['title'];
        $this->content = $post['content'];
        $this->postId = $post['id'];

    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|min:6',
            'content' => 'required|string|max:500',
        ]);

        if ($this->postId) {
            $post = Post::find($this->postId);
            $post->update([
                'title' => $this->title,
                'content' => $this->content,
            ]);

            $this->resetInput();

            $this->emit('postUpdate', $post);
        }
    }
    public function resetInput()
    {
        $this->title   = '';
        $this->content = '';
    }
}
