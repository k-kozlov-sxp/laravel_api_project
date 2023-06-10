<?php

namespace App\Domain\Items\Actions;

use App\Domain\Items\Models\Item;
use Illuminate\Support\Collection;

class GetAllItemsAction
{
    public function execute(): Collection
    {
        return Item::all();
    }
}
