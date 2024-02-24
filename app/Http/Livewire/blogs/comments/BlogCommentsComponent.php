<?php

namespace App\Http\Livewire\blogs\comments;

use Livewire\Component;
use Illuminate\View\View;
use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Comment;
use App\Domain\Blog\Notifications\NotifySlackOfCommentNotification;

class BlogCommentsComponent extends Component
{
    public Blog $blog;

    public $comment = '';
    public $comments;
    public bool $showRegisterModal = false;

    protected $listeners = ['refreshComponent' => '$refresh'];

    protected function rules(): array
    {
        return [
            'comment' => ['required', 'string', 'min:5', 'max:999'],
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
        if (!auth()->check()) {
            $this->showRegisterModal = true;

            $this->emitSelf('refreshComponent');

            return;
        }

        $this->validate();

        $comment = Comment::create([
            'user_id' => auth()->user()->id,
            'comment' => $this->comment
        ]);

        $this->blog->comments()->attach($comment);

        auth()->user()->notify(new NotifySlackOfCommentNotification($comment, $this->blog));

        $this->comments->push($comment);

        $this->comment = '';
    }

    public function render(): View
    {
        return view('livewire.blogs.comments.blog-comments');
    }
}
