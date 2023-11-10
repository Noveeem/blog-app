<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class BlogPostList extends Component
{
    
    public function render()
    {
        return view('livewire.blog-post-list', [
            'posts' => Post::paginate(5),
        ]);
    }
}
