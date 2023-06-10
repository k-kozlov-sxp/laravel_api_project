<?php

namespace App\Domain\Bookings\Actions;

use App\Domain\Bookings\Models\Booking;
use App\Domain\Bookings\Services\BookingAvailabilityChecker;
use App\Exceptions\IncorrectDateException;
use Carbon\Carbon;

class CreateBookingAction
{
    private $availabilityChecker;

    public function __construct(BookingAvailabilityChecker $availabilityChecker)
    {
        $this->availabilityChecker = $availabilityChecker;
    }

    public function execute(array $data): ?Booking
    {
        $startDate = Carbon::parse($data['start_date']);
        $endDate = Carbon::parse($data['end_date']);

        $this->availabilityChecker->checkAvailability($data['item_id'], $startDate, $endDate);

        return Booking::create([
            'item_id' => $data['item_id'],
            'start_date' => $startDate->toDateTimeString(),
            'end_date' => $endDate->toDateTimeString(),
        ]);
    }
}
