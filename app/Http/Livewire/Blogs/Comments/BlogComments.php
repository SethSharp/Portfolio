<?php

namespace App\Http\Livewire\Blogs\Comments;

use Livewire\Component;
use Illuminate\View\View;
use SethSharp\BlogCrud\Models\Blog\Blog;
use SethSharp\BlogCrud\Models\Blog\Comment;
use App\Domain\Blog\Notifications\NotifySlackOfCommentNotification;

class BlogComments extends Component
{
    public Blog $blog;

    public $comment = '';
    public $comments;
    public bool $showRegisterModal = false;

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
            // sets the intended url so when the user registers or logs in - redirects to here
            session(['url.intended' => route('blogs.show', $this->blog)]);

            $this->showRegisterModal = true;

            return;
        }

        $this->validate();

        $comment = Comment::create([
            'user_id' => auth()->user()->id,
            'comment' => $this->comment
        ]);

        $this->blog->comments()->attach($comment);

        //        dd(auth()->user());
        auth()->user()->notify(new NotifySlackOfCommentNotification($comment, $this->blog));

        $this->comments->push($comment);

        $this->comment = '';
    }

    public function render(): View
    {
        return view('livewire.blogs.comments.blog-comments');
    }
}
