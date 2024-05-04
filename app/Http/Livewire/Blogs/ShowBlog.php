<?php

namespace App\Http\Livewire\Blogs;

use Livewire\Component;
use Illuminate\View\View;
use SethSharp\BlogCrud\Models\Blog\Blog;
use SethSharp\BlogCrud\Models\Blog\Collection;

class ShowBlog extends Component
{
    public Blog $blog;
    public ?Blog $prev;
    public ?Blog $next;
    public ?Collection $collection;
    public ?Blog $recentBlog;

    public int $blogLikes = 0;
    public bool $isLiked = false;
    public bool $showRegisterModal = false;

    public function mount(Blog $blog): void
    {
        $this->blog = $blog;
        $this->recentBlog = Blog::whereNot('id', $this->blog->id)->published()->latest()?->first();
        $this->blogLikes = $this->blog->likes()->count();

        if (auth()->check()) {
            $this->isLiked = auth()->user()->likedBlogs->contains('id', $this->blog->id);
        }

        $this->getSeries();
    }

    public function getSeries(): void
    {
        $this->collection = $this->blog->collection()->first();

        if ($order = $this->collection?->getBlogOrder($this->blog)) {
            $this->prev = $this->collection->blogs()->where('order', $order - 1)->published()->first();
            $this->next = $this->collection->blogs()->where('order', $order + 1)->published()->first();
        }
    }

    public function like(): void
    {
        if (! auth()->check()) {
            // sets the intended url so when the user registers or logs in - redirects to here
            session(['url.intended' => route('blogs.show', $this->blog)]);

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
        return view('livewire.blogs.show-blog');
    }
}
