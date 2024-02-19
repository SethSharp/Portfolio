<?php

namespace App\Http\Livewire\blogs;

use Livewire\Component;
use Illuminate\View\View;
use App\Domain\Blog\Models\Blog;

class ShowBlog extends Component
{
    public Blog $blog;

    public int $blogLikes = 0;
    public bool $isLiked = false;
    public bool $showRegisterModal = false;

    public function mount(Blog $blog): void
    {
        $this->blog = $blog;

        $this->blogLikes = $this->blog->likes()->count();

        if (auth()->check()) {
            $this->isLiked = auth()->user()->likedBlogs->contains('id', $this->blog->id);
        }
    }

    public function like(): void
    {
        if (! auth()->check()) {
            $this->showRegisterModal = true;

            return;
        }

        if ($this->isLiked) {
            $this->blog->likes()->detach(auth()->user()->id);

            $this->isLiked = false;
            $this->blogLikes = $this->blogLikes - 1;
        } else {
            $this->blog->likes()->attach(auth()->user()->id);

            $this->isLiked = true;
            $this->blogLikes = $this->blogLikes + 1;
        }
    }

    public function render(): View
    {
        return view('livewire.blogs.show-blog', [
            'blog' => $this->blog,
            'content' => $this->blog->getContent()
        ])
            ->layout('layouts.main');
    }
}
