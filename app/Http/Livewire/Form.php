<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Post;

class Form extends Component
{
    use WithFileUploads;

    public $iteration;
    public $image;
    public $isUpdate = false;
    public $title;
    public $content;
    public $postId;


    protected $listeners = [
        'getPost' => 'showPost',
        'getUpdate' => 'update',
    ];
    public function render()
    {
        return view('livewire.form');
    }
    public function showPost($post)
    {
        $this->title = $post['title'];
        $this->content = $post['content'];
        $this->postId = $post['id'];
        $this->image = $post['image'];

    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|min:6',
            'content' => 'required|string|max:500',
            'image' => 'image|max:1024', // 1MB Max

        ]);


        if($this->postId){
            $post = Post::find($this->postId);
            $imageName = now()->format('Y-m') . '.' . $this->image->extension();
            $imageName = $this->image->store('images','public');
            $this->image=null;
            $this->iteration++;
            $post->update([
                'title' => $this->title,
                'content' => $this->content,
                'image' =>$imageName,
            ]);
        }else{
            $imageName = now()->format('Y-m') . '.' . $this->image->extension();
            $imageName = $this->image->store('images','public');
            $this->image=null;
            $this->iteration++;
            $post = Post::create([
                'title' =>$this->title,
                'content' =>$this->content,
                'image' =>$imageName,
               ]);
        }

        $this->resetInput();

        $this->emit('postSave', $post);
    }

    public function resetInput()
    {
        $this->title   = '';
        $this->content = '';
        $this->postId = '';
        $this->image = '';

    }

    public function isUpdate()
    {
        $this->isUpdate = true;
    }
}
