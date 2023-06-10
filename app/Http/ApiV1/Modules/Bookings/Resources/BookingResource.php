<?php

namespace App\Http\ApiV1\Modules\Bookings\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'data' => [
                'id' => $this->id,
                'item_id' => $this->item_id,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ],
        ];
    }
}
