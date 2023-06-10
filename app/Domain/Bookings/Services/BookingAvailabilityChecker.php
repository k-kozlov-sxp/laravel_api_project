<?php

namespace App\Domain\Bookings\Services;

use App\Domain\Bookings\Models\Booking;
use App\Exceptions\IncorrectDateException;
use Carbon\Carbon;

class BookingAvailabilityChecker
{
    public function checkAvailability(int $itemId, Carbon $startDate, Carbon $endDate): void
    {
        $existingBooking = Booking::where('item_id', $itemId)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                    });
            })
            ->first();

        if ($existingBooking) {
            throw new IncorrectDateException('This item is already booked for the specified time');
        }
    }
}
