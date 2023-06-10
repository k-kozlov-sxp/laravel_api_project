<?php

namespace App\Http\ApiV1\Modules\Bookings\Controllers;

use App\Domain\Bookings\Actions\CreateBookingAction;
use App\Domain\Bookings\Actions\DeleteBookingAction;
use App\Domain\Bookings\Actions\GetAllBookingsAction;
use App\Domain\Bookings\Actions\GetBookingAction;
use App\Domain\Bookings\Actions\ReplaceBookingAction;
use App\Domain\Bookings\Actions\UpdateBookingAction;

use App\Exceptions\NotFoundException;

use App\Http\ApiV1\Modules\Bookings\Requests\CreateBookingRequest;
use App\Http\ApiV1\Modules\Bookings\Requests\ReplaceBookingRequest;
use App\Http\ApiV1\Modules\Bookings\Requests\UpdateBookingRequest;
use App\Http\ApiV1\Modules\Bookings\Resources\AllBookingsResource;
use App\Http\ApiV1\Modules\Bookings\Resources\BookingResource;

use Illuminate\Http\JsonResponse;

class BookingController
{
    public function index(GetAllBookingsAction $action): AllBookingsResource
    {
        $bookings = $action->execute();
        return new AllBookingsResource($bookings);
    }

    public function store(CreateBookingAction $action,
                          CreateBookingRequest $request): BookingResource|JsonResponse
    {
        $booking = $action->execute($request->validated());
        if (!$booking) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new BookingResource($booking);
    }

    public function show(int $id,
                         GetBookingAction $action): BookingResource|JsonResponse
    {
        try {
            $booking = $action->execute($id);
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        if (!$booking) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new BookingResource($booking);
    }

    public function replace(int $id,
                            ReplaceBookingAction $action,
                            ReplaceBookingRequest $request): BookingResource|JsonResponse
    {
        try {
            $booking = $action->execute($id, $request->validated());
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        if (!$booking) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new BookingResource($booking);
    }

    public function update(int $id,
                           UpdateBookingAction $action,
                           UpdateBookingRequest $request): BookingResource|JsonResponse
    {
        try {
            $booking = $action->execute($id, $request->validated());
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        if (!$booking) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new BookingResource($booking);
    }

    public function destroy(int $id,
                            DeleteBookingAction $action): JsonResponse
    {
        try {
            $action->execute($id);
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        return response()->json(['data' => null]);
    }
}
