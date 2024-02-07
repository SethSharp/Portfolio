<?php

namespace App\Http\Requests\Dashboard\Blogs;

use App\Domain\Blog\Models\Blog;
use Illuminate\Foundation\Http\FormRequest;

class StoreBlogImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('store', Blog::class);
    }

    public function rules(): array
    {
        return [
            'file' => 'required|image|max:2000',
        ];
    }
}
