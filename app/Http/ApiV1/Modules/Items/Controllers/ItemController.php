<?php

namespace App\Http\ApiV1\Modules\Items\Controllers;

use App\Domain\Items\Actions\CreateItemAction;
use App\Domain\Items\Actions\DeleteItemAction;
use App\Domain\Items\Actions\GetAllBookingsForSpecificItemAction;
use App\Domain\Items\Actions\GetAllItemsAction;
use App\Domain\Items\Actions\GetItemAction;
use App\Domain\Items\Actions\ReplaceItemAction;
use App\Domain\Items\Actions\UpdateItemAction;

use App\Exceptions\NotFoundException;

use App\Http\ApiV1\Modules\Bookings\Resources\AllBookingsResource;
use App\Http\ApiV1\Modules\Items\Requests\CreateItemRequest;
use App\Http\ApiV1\Modules\Items\Requests\ReplaceItemRequest;
use App\Http\ApiV1\Modules\Items\Requests\UpdateItemRequest;
use App\Http\ApiV1\Modules\Items\Resources\AllItemsResource;
use App\Http\ApiV1\Modules\Items\Resources\ItemResource;

use Illuminate\Http\JsonResponse;

class ItemController
{
    public function index(GetAllItemsAction $action): AllItemsResource
    {
        $items = $action->execute();
        return new AllItemsResource($items);
    }

    public function store(CreateItemAction $action,
                          CreateItemRequest $request): ItemResource|JsonResponse
    {
        $item = $action->execute($request->validated());
        if (!$item) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new ItemResource($item);
    }

    public function show(int $id,
                         GetItemAction $action): ItemResource|JsonResponse
    {
        try {
            $item = $action->execute($id);
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        if (!$item) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new ItemResource($item);
    }

    public function replace(int $id,
                            ReplaceItemAction $action,
                            ReplaceItemRequest $request): ItemResource|JsonResponse
    {
        try {
            $item = $action->execute($id, $request->validated());
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        if (!$item) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new ItemResource($item);
    }

    public function update(int $id,
                           UpdateItemAction $action,
                           UpdateItemRequest $request): ItemResource|JsonResponse
    {
        try {
            $item = $action->execute($id, $request->validated());
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        if (!$item) {
            return response()->json(['data' => 'Bad request'], 400);
        }
        return new ItemResource($item);
    }

    public function destroy(int $id,
                            DeleteItemAction $action): JsonResponse
    {
        try {
            $action->execute($id);
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        return response()->json(['data' => null]);
    }

    public function getAllBookingsForSpecificItem(int $itemId,
                                                  GetAllBookingsForSpecificItemAction $action): JsonResponse|AllBookingsResource
    {
        try {
            $bookings = $action->execute($itemId);
        } catch (NotFoundException $exception) {
            return response()->json(['data' => null, 'errors' => $exception->getMessage()], 404);
        }
        return new AllBookingsResource($bookings);
    }
}
