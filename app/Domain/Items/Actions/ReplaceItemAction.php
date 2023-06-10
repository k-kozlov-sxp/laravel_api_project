<?php

namespace App\Domain\Items\Actions;

use App\Domain\Items\Models\Item;
use App\Exceptions\NotFoundException;

class ReplaceItemAction
{
    public function execute(int $itemId, array $data): ?Item
    {
        $item = Item::find($itemId);
        if (!$item) {
            throw new NotFoundException('Item not found');
        }
        $item->update($data);
        $item->save();
        return $item;
    }
}
