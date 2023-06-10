<?php

namespace App\Http\ApiV1\Modules\Bookings\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'item_id' => ['required', 'exists:items,id'],
            'start_date' => ['required', 'date_format:Y-m-d H:i'],
            'end_date' => ['required', 'date_format:Y-m-d H:i', 'after:start_date'],
        ];
    }
}
