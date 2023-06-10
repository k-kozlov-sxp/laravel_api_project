<?php

namespace App\Http\ApiV1\Modules\Bookings\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplaceBookingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'item_id' => ['required', 'exists:items,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'after:start_date'],
        ];
    }
}
