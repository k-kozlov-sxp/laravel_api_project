<?php

use App\Domain\Bookings\Models\Booking;

test('/bookings GET (200)', function () {
    $response = $this->getJson('/api/v1/bookings');
    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'data' => [
                    'id',
                    'item_id',
                    'start_date',
                    'end_date'
                ]
            ]
        ]
    ]);
});

test('/bookings POST (201)', function () {
    $data = [
        'item_id' => 1,
        'start_date' => '2023-05-21 13:00',
        'end_date' => '2023-05-21 15:00',
    ];
    $response = $this->postJson('/api/v1/bookings', $data);
    $response->assertStatus(201);
    $this->assertDatabaseHas(Booking::class, $data);
});

test('/bookings/{bookingId} GET (200)', function () {
    $bookingId = Booking::max('id');
    $response = $this->getJson("/api/v1/bookings/$bookingId");
    $response->assertStatus(200);
});

test('/bookings/{bookingId} GET (404)', function () {
    $bookingId = 100;
    $response = $this->getJson("/api/v1/bookings/$bookingId");
    $response->assertStatus(404);
});

test('/bookings/{bookingId} PUT (200)', function () {
    $bookingId = Booking::max('id');
    $data = [
        'item_id' => 1,
        'start_date' => '2023-05-21 17:00',
        'end_date' => '2023-05-21 18:00',
    ];
    $response = $this->putJson("/api/v1/bookings/$bookingId", $data);
    $response->assertStatus(200);
});

test('/bookings/{bookingId} PUT (404)', function () {
    $bookingId = 100;
    $data = [
        'item_id' => 1,
        'start_date' => '2023-05-21 17:00',
        'end_date' => '2023-05-21 18:00',
    ];
    $response = $this->putJson("/api/v1/bookings/$bookingId", $data);
    $response->assertStatus(404);
});

test('/bookings/{bookingId} PATCH (200)', function () {
    $bookingId = Booking::max('id');
    $data = [
        'start_date' => '2023-05-21 14:30',
    ];
    $response = $this->patchJson("/api/v1/bookings/$bookingId", $data);
    $response->assertStatus(200);
});

test('/bookings/{bookingId} PATCH (404)', function () {
    $bookingId = 100;
    $data = [
        'start_date' => '2023-05-21 14:30',
    ];
    $response = $this->patchJson("/api/v1/bookings/$bookingId", $data);
    $response->assertStatus(404);
});

test('/bookings/{bookingId} DELETE (200)', function () {
    $bookingId = Booking::max('id');
    $response = $this->deleteJson("/api/v1/bookings/$bookingId");
    $response->assertStatus(200);
});

test('/bookings/{bookingId} DELETE (404)', function () {
    $bookingId = 100;
    $response = $this->deleteJson("/api/v1/bookings/$bookingId");
    $response->assertStatus(404);
});
