<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Comments extends Component
{
    public int $imgwidth;
    public bool $overflow;
    public Post $post;


    public function mount($imgwidth, $overflow, $post)
    {
        $this->imgwidth = $imgwidth;
        $this->overflow = $overflow;
        $this->post = $post;
    }
    public function refreshData()
    {
        $this->post = Post::find($this->post->id);
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
