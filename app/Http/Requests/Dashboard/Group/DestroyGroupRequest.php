<?php

namespace App\Http\Requests\Dashboard\Group;

use App\Domain\Blog\Models\Group;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class DestroyGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('manage', Group::class);
    }

    public function rules(): array
    {
        return [];
    }

    public function withValidator($validator): void
    {
        $validator->validate();

        $validator->after(function (Validator $validator) {
            $group = $this->route('group');

            if ($group->blogs()->count()) {
                $validator->errors()->add('group', 'This group has 1 or more blogs attached.');
            }
        });
    }
}
