<?php

namespace Tests\Domain\Blog\Models;

use Tests\TestCase;
use Mockery\MockInterface;
use App\Domain\Blog\Models\Blog;
use App\Support\Cache\CacheKeys;
use Illuminate\Support\Facades\Cache;

class BlogTest extends TestCase
{
    protected MockInterface $blogMock;

    /** @test */
    public function get_content_will_return_cached_version_if_cache_exists()
    {
        $blog = Blog::factory()->create();

        Cache::put(CacheKeys::renderedBlogContent($blog), $blog->content);

        $blog->getContent();

        $this->markTestSkipped();
    }

    /** @test */
    public function blog_rendered_content_is_cached()
    {
        $this->markTestSkipped();
    }
}
