<?php

namespace App\Domain\Items\Actions;

use App\Domain\Items\Models\Item;
use App\Exceptions\NotFoundException;

class GetAllBookingsForSpecificItemAction
{
    public function execute(int $itemId)
    {
        $item = Item::find($itemId);
        if (!$item) {
            throw new NotFoundException('Item not found');
        }
        return $item->bookings()->orderBy('start_date')->get();
    }
}
