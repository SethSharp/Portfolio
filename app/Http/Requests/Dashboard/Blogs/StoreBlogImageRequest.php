<?php

namespace App\Http\Requests\Dashboard\Blogs;

use App\Domain\Blog\Models\Blog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBlogImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('store', Blog::class);
    }

    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file'
            ],
            'file_id' => [
                'nullable',
                'string'
            ],
            'blog_id' => [
                'int',
                Rule::exists(Blog::class, 'id')
            ],
        ];
    }
}
