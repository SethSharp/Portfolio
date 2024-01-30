<?php

namespace App\Http\Requests\Dashboard\Blogs;

use Illuminate\Validation\Rule;
use App\Domain\Blog\Models\Blog;
use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
                Rule::unique(Blog::class, 'title'),
            ],
            'slug' => [
                'required',
                'string',
                Rule::unique(Blog::class, 'slug'),
            ],
            'content' => [
                'required',
                'string',
            ],
            'draft' => [
                'nullable',
                'boolean'
            ]
        ];
    }
}
