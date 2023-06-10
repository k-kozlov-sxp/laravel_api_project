<?php

namespace App\Domain\Bookings\Actions;

use App\Domain\Bookings\Models\Booking;
use Illuminate\Support\Collection;

class GetAllBookingsAction
{
    public function execute(): Collection
    {
        return Booking::all();
    }
}
