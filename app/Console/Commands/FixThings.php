<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use SethSharp\BlogCrud\Models\Blog\Blog;

class FixThings extends Command
{
    protected $signature = 'fix:things {--slug=} {--time=}';
    protected $description = 'does something...';

    public function handle(): void
    {
        if (! $this->option('slug') || ! $this->option('time')) {
            $this->error('make sure you have provided the slug and time options');
            return;
        }

        $blog = Blog::whereSlug($this->option('slug'))->first();

        if ($blog) {
            $publishedAt = Carbon::parse($this->option('time'));

            $blog->update([
                'published_at' => $publishedAt
            ]);
        }
    }
}
