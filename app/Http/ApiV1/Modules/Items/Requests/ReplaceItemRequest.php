<?php

namespace App\Http\ApiV1\Modules\Items\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplaceItemRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'company' => ['required', 'string'],
        ];
    }
}
