<?php

namespace App\Domain\Blog\Actions;

use App\Domain\File\Actions\DestroyFileAction;
use Illuminate\Support\Str;
use App\Domain\Blog\Models\Blog;
use App\Domain\File\Models\File;
use App\Http\Requests\Dashboard\Blogs\StoreBlogRequest;

class CleanBlogContentAction
{
    public function __invoke(Blog $blog): Blog
    {
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

        // Sometimes a file may be deleted within the editor, this finds all the file ids and ensures they are all exist
        // otherwise delete the unused ones (s3 and entry)

        $matches = [];
        preg_match_all('/fileid="([^"]+)"/', $blog->content, $matches);

        $fileIds = $matches[1];

        foreach ($files as $file) {
            if (!in_array((string)$file->id, $fileIds)) {
                app(DestroyFileAction::class)($file);

                $file->delete();
            }
        }

        return $blog;
    }
}
