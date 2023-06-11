<?php

use App\Domain\Items\Models\Item;

test('/items GET (200)', function () {
    $response = $this->getJson('/api/v1/items');
    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'data' => [
                    'id',
                    'name',
                    'company'
                ]
            ]
        ]
    ]);
});

test('/items POST (201)', function () {
    $data = [
        'name' => 'Kia Rio',
        'company' => 'Yandex.Drive',
    ];
    $response = $this->postJson('/api/v1/items', $data);
    $response->assertStatus(201);
    $this->assertDatabaseHas(Item::class, $data);
});

test('/items/{itemId} GET (200)', function () {
    $itemId = Item::max('id');
    $response = $this->getJson("/api/v1/items/$itemId");
    $response->assertStatus(200);
});

test('/items/{itemId} GET (404)', function () {
    $itemId = 100;
    $response = $this->getJson("/api/v1/items/$itemId");
    $response->assertStatus(404);
});

test('/items/{itemId} PUT (200)', function () {
    $itemId = Item::max('id');
    $data = [
        'name' => 'Ford Fiesta',
        'company' => 'BelkaCar',
    ];
    $response = $this->putJson("/api/v1/items/$itemId", $data);
    $response->assertStatus(200);
});

test('/items/{itemId} PUT (404)', function () {
    $itemId = 100;
    $data = [
        'name' => 'Ford Fiesta',
        'company' => 'BelkaCar',
    ];
    $response = $this->putJson("/api/v1/items/$itemId", $data);
    $response->assertStatus(404);
});

test('/items/{itemId} PATCH (200)', function () {
    $itemId = Item::max('id');
    $data = [
        'name' => 'Mercedes CLA',
    ];
    $response = $this->patchJson("/api/v1/items/$itemId", $data);
    $response->assertStatus(200);
});

test('/items/{itemId} PATCH (404)', function () {
    $itemId = 100;
    $data = [
        'name' => 'Mercedes CLA',
    ];
    $response = $this->patchJson("/api/v1/items/$itemId", $data);
    $response->assertStatus(404);
});

test('/items/{itemId} DELETE (200)', function () {
    $itemId = Item::max('id');
    $response = $this->deleteJson("/api/v1/items/$itemId");
    $response->assertStatus(200);
});

test('/items/{itemId} DELETE (404)', function () {
    $itemId = 100;
    $response = $this->deleteJson("/api/v1/items/$itemId");
    $response->assertStatus(404);
});
