<?php

namespace App\Domain\Bookings\Actions;

use App\Domain\Bookings\Models\Booking;
use App\Exceptions\NotFoundException;

class UpdateBookingAction
{
    public function execute(int $bookingId, array $data): ?Booking
    {
        $booking = Booking::find($bookingId);
        if (!$booking) {
            throw new NotFoundException('Booking not found');
        }

        $booking->fill($data);
        $booking->save();
        return $booking;
    }
}
