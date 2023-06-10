<?php

namespace App\Http\ApiV1\Modules\Bookings\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'item_id' => ['exists:items,id'],
            'start_date' => ['date'],
            'end_date' => ['after:start_date'],
        ];
    }
}
