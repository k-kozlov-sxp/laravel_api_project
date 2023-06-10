<?php

namespace App\Http\ApiV1\Modules\Items\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllItemsResource extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => ItemResource::collection($this->collection),
        ];
    }
}
