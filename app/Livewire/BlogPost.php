<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class BlogPost extends Component
{

    protected $post;

    public function mount($slug){
        $this->post = Post::where('slug', $slug)->first();

        return $this->post;
    }

    public function render()
    {
        return view('livewire.blog-post')
            ->title($this->post->title);
    }
    
}
