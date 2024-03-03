<?php

namespace App\Http\Requests\Dashboard\Series;

use App\Domain\Blog\Models\Series;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class DestroySeriesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('manage', Series::class);
    }

    public function rules(): array
    {
        return [];
    }

    public function withValidator($validator): void
    {
        $validator->validate();

        $validator->after(function (Validator $validator) {
            $series = $this->route('series');

            if ($series->blogs()->count()) {
                $validator->errors()->add('series', 'This series has 1 or more blogs attached.');
            }
        });
    }
}
