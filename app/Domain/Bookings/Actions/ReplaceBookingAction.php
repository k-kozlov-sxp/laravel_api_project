<?php

namespace App\Domain\Bookings\Actions;

use App\Domain\Bookings\Models\Booking;
use App\Domain\Bookings\Services\BookingAvailabilityChecker;
use App\Exceptions\NotFoundException;
use Carbon\Carbon;

class ReplaceBookingAction
{
    private $availabilityChecker;

    public function __construct(BookingAvailabilityChecker $availabilityChecker)
    {
        $this->availabilityChecker = $availabilityChecker;
    }

    public function execute(int $bookingId, array $data): ?Booking
    {
        $booking = Booking::find($bookingId);
        if (!$booking) {
            throw new NotFoundException('Booking not found');
        }

        $startDate = Carbon::parse($data['start_date']);
        $endDate = Carbon::parse($data['end_date']);
        $this->availabilityChecker->checkAvailability($booking->item_id, $startDate, $endDate);

        $booking->update($data);
        $booking->save();
        return $booking;
    }
}
