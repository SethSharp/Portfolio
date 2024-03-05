<?php

namespace App\Http\Requests\Dashboard\Series;

use Illuminate\Validation\Rule;
use App\Domain\Blog\Models\Series;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSeriesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('manage', Series::class);
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                Rule::unique(Series::class, 'title')->ignore($this->route('series')->id),
            ],
            'description' => [
                'required',
                'string',
            ]
        ];
    }
}
