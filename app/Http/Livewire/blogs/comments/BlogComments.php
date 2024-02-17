<?php

namespace App\Http\Livewire\blogs\comments;

use Livewire\Component;
use Illuminate\View\View;
use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Comment;

class BlogComments extends Component
{
    public Blog $blog;

    public $comment = '';
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
        $this->comments = $blog->comments()
            ->with('user')
            ->get()
            ->each(function (Comment $comment) {
                $comment->posted = $comment->created_at->diffForHumans();

                return $comment;
            });
    }

    public function save(): void
    {
        if (is_null(auth()->user())) {
            // add front end error here and maybe pop up a modal to register?
            $this->showRegisterModal = true;

            return;
        }

        $this->validate();

        $comment = Comment::create([
            'user_id' => auth()->user()->id,
            'comment' => $this->comment
        ]);

        $this->blog->comments()->attach($comment);

        $this->comments->push($comment);
    }

    public function render(): View
    {
        return view('livewire.blogs.comments.blog-comments');
    }
}
