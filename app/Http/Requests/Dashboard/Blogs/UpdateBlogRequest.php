<?php

namespace App\Http\Requests\Dashboard\Blogs;

use Illuminate\Validation\Rule;
use App\Domain\Blog\Models\Blog;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //        return auth()->user()->can('create', Blog::class);
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                Rule::unique(Blog::class, 'title')->ignore($this->route('blog')->id),
            ],
            'slug' => [
                'required',
                'string',
                Rule::unique(Blog::class, 'slug')->ignore($this->route('blog')->id),
            ],
            'meta_title' => [
                'string',
            ],
            'meta_tags' => [
                'string',
            ],
            'meta_description' => [
                'string',
            ],
            'content' => [
                'required',
                'string',
            ],
            'is_draft' => [
                'required',
                'boolean'
            ]
        ];
    }
}
