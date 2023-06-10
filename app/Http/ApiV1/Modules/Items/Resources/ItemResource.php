<?php

namespace App\Http\ApiV1\Modules\Items\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'company' => $this->company,
            ],
        ];
    }
}
