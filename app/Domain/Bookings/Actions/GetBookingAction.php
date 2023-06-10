<?php

namespace App\Domain\Bookings\Actions;

use App\Domain\Bookings\Models\Booking;
use App\Exceptions\NotFoundException;

class GetBookingAction
{
    public function execute(int $bookingId): ?Booking
    {
        $booking = Booking::find($bookingId);
        if (!$booking) {
            throw new NotFoundException('Booking not found');
        }
        return $booking;
    }
}
