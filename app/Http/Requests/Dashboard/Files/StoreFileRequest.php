<?php

namespace App\Http\Requests\Dashboard\Files;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'file' => 'required|image|max:2000',
        ];
    }
}
