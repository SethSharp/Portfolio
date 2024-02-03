<?php

namespace App\Http\Livewire\blogs;

use Livewire\Component;
use App\Domain\Blog\Models\Blog;

class ShowBlog extends Component
{
    public Blog $blog;

    public function mount(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function render()
    {
        return view('livewire.blogs.show-blog', [
            'blog' => $this->blog
        ])
            ->layout('layouts.main');
    }
}
