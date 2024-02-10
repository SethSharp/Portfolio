<?php

namespace App\Domain\Blog\Models;

use App\Domain\Iam\Models\User;
use App\Domain\Blog\Nodes\EditorNodes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'blog_tag')
            ->withTimestamps();
    }

    public function getContent(): string
    {
        // check if cache exists and hasn't been cleared
        // if not return cache

        // else
        return $this->render();
    }

    public function render(): string
    {
        $nodes = app(EditorNodes::class)::$components;

        $result = $this->content;

        foreach ($nodes as $node) {
            $result = str_replace($node::buildHtmlTag(), $node::getReplaceTag(), $result);
        }

        return $this->cacheResult($result);
    }

    private function cacheResult(string $content): string
    {
        return $content;
    }
}
