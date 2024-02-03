<?php

namespace App\Http\Requests\Dashboard\Tags;

use App\Domain\Blog\Models\Tag;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('store', Tag::class);
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique(Tag::class, 'name'),
            ],
        ];
    }
}
