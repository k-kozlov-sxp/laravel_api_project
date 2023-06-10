<?php

namespace App\Domain\Items\Actions;

use App\Domain\Items\Models\Item;
use App\Exceptions\NotFoundException;

class GetItemAction
{
    public function execute(int $itemId): ?Item
    {
        $item = Item::find($itemId);
        if (!$item) {
            throw new NotFoundException('Item not found');
        }
        return $item;
    }
}
