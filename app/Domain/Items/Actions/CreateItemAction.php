<?php

namespace App\Domain\Items\Actions;

use App\Domain\Items\Models\Item;

class CreateItemAction
{
    public function execute(array $data): ?Item
    {
        return Item::create([
            'name' => $data['name'],
            'company' => $data['company']
        ]);
    }
}
