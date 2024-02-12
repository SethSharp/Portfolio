<?php

namespace App\Http\Livewire\blogs\comments;

use Livewire\Component;
use Illuminate\View\View;
use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Comment;

class BlogComments extends Component
{
    public Blog $blog;

    public $comment;
    public $comments;
    public bool $showRegisterModal = false;

    protected function rules(): array
    {
        return [
            'comment' => ['required', 'string', 'max:999'],
        ];
    }

    public function mount(Blog $blog): void
    {
        $this->blog = $blog;
        $this->comments = $blog->comments()->get();
    }

    public function save(): void
    {
        if (is_null(auth()->user())) {
            // add front end error here and maybe pop up a modal to register?
            $this->showRegisterModal = true;

            return;
        }

        $this->validate();

        Comment::create([
            'blog_id' => $this->blog->id,
            'user_id' => auth()->user()->id,
            'comment' => $this->comment
        ]);
    }

    public function render(): View
    {
        return view('livewire.blogs.comments.blog-comments');
    }
}
