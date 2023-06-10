<?php

namespace App\Http\ApiV1\Modules\Items\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['string'],
            'company' => ['string'],
        ];
    }
}
