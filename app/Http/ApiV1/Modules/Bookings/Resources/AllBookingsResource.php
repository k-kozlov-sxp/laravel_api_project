<?php

namespace App\Http\ApiV1\Modules\Bookings\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllBookingsResource extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => BookingResource::collection($this->collection),
        ];
    }
}

