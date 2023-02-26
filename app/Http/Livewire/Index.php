<?php

namespace App\Http\Livewire;

use Illuminate\Queue\Listener;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class Index extends Component
{
    use WithPagination;
    public $statusUpdate = false;
    public $paginate = 5;
    public $search;

    protected $listeners = [
        'postSave' => 'handleSave',
        'postUpdate' => 'handleUpdate',
    ];

    protected $queryString  = ['search'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }
    public function render()
    {
        return view('livewire.index', [
            'posts' => $this->search === null ?
                Post::latest()->paginate($this->paginate) :
                Post::latest()->where('title', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);

    }

    public function getPost($id)
    {
        $this->statusUpdate = true;
        $post = Post::find($id);
        $this->emit('getPost', $post);
    }

    public function destroy($id)
    {
        if($id){
            $post = Post::find($id);
            $post->delete();
            session()->flash('message', 'Post was deleted!');
        }
    }

    public function handleSave($post)
    {
        session()->flash('message', 'Post' . $post['title'] . 'was strorage!');

    }

    public function handleUpdate($post)
    {
        session()->flash('message', 'Post' . $post['title'] . 'was update!');
    }

    public function clearMessage()
    {
        session()->forget('message');
    }

}
