<?php

namespace App\Http\Requests\Dashboard\Group;

use Illuminate\Validation\Validator;
use App\Domain\Blog\Models\Collection;
use Illuminate\Foundation\Http\FormRequest;

class DestroyCollectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('manage', Collection::class);
    }

    public function rules(): array
    {
        return [];
    }

    public function withValidator($validator): void
    {
        $validator->validate();

        $validator->after(function (Validator $validator) {
            $group = $this->route('collection');

            if ($group->blogs()->count()) {
                $validator->errors()->add('collection', 'This collection has 1 or more blogs attached.');
            }
        });
    }
}
