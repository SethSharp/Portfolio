<?php

namespace App\Http\Requests\Dashboard\Blogs;

use Illuminate\Validation\Rule;
use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Collection;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', [Blog::class, $this->route('blog')]);
    }

    public function rules(): array
    {
        return [
            'cover_image' => [
                'nullable',
                'image',
                'exclude'
            ],
            'title' => [
                'required',
                'string',
                Rule::unique(Blog::class, 'title')->ignore($this->route('blog')->id),
            ],
            'collection_id' => [
                'nullable',
                'int',
                'exclude',
                Rule::exists(Collection::class, 'id')
            ],
            'slug' => [
                'nullable',
                'string',
                Rule::unique(Blog::class, 'slug')->ignore($this->route('blog')->id),
            ],
            'tags' => [
                'array',
                'exclude',
            ],
            'meta_title' => [
                'nullable',
                'required_if:is_draft,false',
                'string',
            ],
            'meta_tags' => [
                'nullable',
                'required_if:is_draft,false',
                'string',
            ],
            'meta_description' => [
                'nullable',
                'required_if:is_draft,false',
                'string',
            ],
            'content' => [
                'required_if:is_draft,false',
                'string',
            ],
            'is_draft' => [
                'required',
                'boolean'
            ]
        ];
    }
}
