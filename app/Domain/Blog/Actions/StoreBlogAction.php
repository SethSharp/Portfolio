<?php

namespace App\Domain\Blog\Actions;

use App\Domain\File\Models\File;
use Illuminate\Support\Str;
use App\Domain\Blog\Models\Blog;
use App\Http\Requests\Dashboard\Blogs\StoreBlogRequest;

class StoreBlogAction
{
    public function __invoke(StoreBlogRequest $storeBlogRequest): Blog
    {
        $storeBlogRequest['slug'] = Str::slug($storeBlogRequest->input('slug'));

        $tags = collect($storeBlogRequest->input('tags'))->pluck('id');

        $blog = Blog::create([
            'author_id' => auth()->user()->id,
            ...$storeBlogRequest->validated(),
        ]);

        $blog->tags()->sync($tags);

        // recent files that need replacing
        $files = File::whereNull('blog_id')
            ->get();

        $files->each(function (File $file) use ($blog) {
            $file->update(['blog_id' => $blog->id]);
        });

        $content = $blog->content;

        $newContent = str_replace('blogid="null"', 'blogid="' . $blog->id . '"', $content);

        $blog->update([
            'content' => $newContent
        ]);

        return $blog;
    }
}
