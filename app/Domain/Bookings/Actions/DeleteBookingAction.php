<?php

namespace App\Domain\Bookings\Actions;

use App\Domain\Bookings\Models\Booking;
use App\Exceptions\NotFoundException;

class DeleteBookingAction
{
    public function execute(int $bookingId): void
    {
        $booking = Booking::find($bookingId);
        if (!$booking) {
            throw new NotFoundException('Booking not found');
        }
        $booking->delete();
    }
}
