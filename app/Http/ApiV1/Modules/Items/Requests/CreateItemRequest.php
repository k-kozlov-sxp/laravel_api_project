<?php

namespace App\Http\ApiV1\Modules\Items\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateItemRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'company' => ['required', 'string'],
        ];
    }
}
