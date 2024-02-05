<?php

namespace App\Http\Requests\Dashboard\Files;

class StoreFileRequest extends \Illuminate\Foundation\Http\FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => 'required|image|max:2000',
            'description' => ['min:5']
        ];
    }
}
