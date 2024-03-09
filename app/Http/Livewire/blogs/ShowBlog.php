<?php

namespace App\Http\Livewire\blogs;

use Livewire\Component;
use Illuminate\View\View;
use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Collection;

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
        $this->recentBlog = Blog::whereNot('id', $this->blog->id)->published()?->latest()?->first();
        $this->blogLikes = $this->blog->likes()->count();

        if (auth()->check()) {
            $this->isLiked = auth()->user()->likedBlogs->contains('id', $this->blog->id);
        }

        $this->getSeries();
    }

    public function getSeries(): void
    {
        $blogCollection = $this->blog->collection()->first();

        if ($order = $blogCollection?->getBlogOrder($this->blog)) {
            $this->collection = $blogCollection;
            $this->prev = $blogCollection->blogs()->where('order', $order - 1)->first();
            $this->next = $blogCollection->blogs()->where('order', $order + 1)->first();
        }
    }

    public function like(): void
    {
        if (!auth()->check()) {
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
        return view('livewire.blogs.show-blog', [
            'blog' => $this->blog,
            'content' => $this->blog->getContent()
        ]);
    }
}
