<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class Create extends Component
{
    public $title;
    public $content;
    public $postId;

     public $statusUpdate = false;

    protected $listeners = [
        'getPost' => 'showPost',
    ];
    public function render()
    {
        return view('livewire.create');
    }

    public function showPost($post)
    {
        $this->statusUpdate = true;
        $this->title = $post['title'];
        $this->content = $post['content'];
        $this->postId = $post['id'];

    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|min:6',
            'content' => 'required|string|max:500',
        ]);

        if($this->postId){
            $post = Post::find($this->postId);
            $post->update([
                'title' => $this->title,
                'content' => $this->content,
            ]);
        }else{
            $post = Post::create([
                'title' =>$this->title,
                'content' =>$this->content,
               ]);
        }

        $this->resetInput();

        $this->emit('postSave', $post);
    }

    public function resetInput()
    {
        $this->statusUpdate = false;
        $this->title   = '';
        $this->content = '';
        $this->postId = '';
    }
}
