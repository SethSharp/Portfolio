<?php

namespace App\Domain\Blog\Actions;

use Illuminate\Support\Str;
use App\Domain\Blog\Models\Blog;
use App\Domain\File\Models\File;
use App\Http\Requests\Dashboard\Blogs\UpdateBlogRequest;

class UpdateBlogAction
{
    public function __invoke(Blog $blog, UpdateBlogRequest $updateBlogRequest): Blog
    {
        $updateBlogRequest['slug'] = Str::slug($updateBlogRequest->input('slug'));

        $tags = collect($updateBlogRequest->input('tags'))->pluck('id');

        $blog->update([
            ...$updateBlogRequest->validated(),
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
