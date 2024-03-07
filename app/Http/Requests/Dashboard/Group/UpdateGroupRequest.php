<?php

namespace App\Http\Requests\Dashboard\Group;

use App\Domain\Blog\Models\Blog;
use Illuminate\Validation\Rule;
use App\Domain\Blog\Models\Group;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('manage', Group::class);
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                Rule::unique(Group::class, 'title')->ignore($this->route('group')->id),
            ],
            'description' => [
                'required',
                'string',
            ],
            'blogs' => [
                'array',
                'nullable'
            ],
            'blogs.*.id' => [
                Rule::exists(Blog::class, 'id')
            ]
        ];
    }
}
