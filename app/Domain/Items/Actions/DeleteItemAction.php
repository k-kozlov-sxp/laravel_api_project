<?php

namespace App\Domain\Items\Actions;

use App\Domain\Items\Models\Item;
use App\Exceptions\NotFoundException;

class DeleteItemAction
{
    public function execute(int $itemId): void
    {
        $item = Item::find($itemId);
        if (!$item) {
            throw new NotFoundException('Item not found');
        }
        $item->delete();
    }
}
