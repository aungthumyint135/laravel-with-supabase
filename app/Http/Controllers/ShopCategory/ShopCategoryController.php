<?php

namespace App\Http\Controllers\ShopCategory;

use App\Foundation\Routing\Controller;
use App\Services\ShopCategory\ShopCategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class ShopCategoryController extends Controller
{

    public function __construct(
        protected ShopCategoryService $service
    )
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        return $this->response($this->service->getAllShopCategories($request));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request): JsonResponse
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }
        $response = $this->service->createShopCategory($request);

        if(!$response) {
            return $this->msgResponse('Failed to create shop category.', 500);
        }

        return $this->response($response->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $shopCategory = $this->service->getShopCategoryByUuid($uuid);

        if (!$shopCategory) {
            return $this->msgResponse('Shop category not found.', 404);
        }

        return $this->response($shopCategory->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        $response = $this->service->updateShopCategory($uuid, $request);

        if (!$response) {
            return $this->msgResponse('Failed to update shop category.', 500);
        }
        return $this->msgResponse('Shop category updated successfully.', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $response = $this->service->deleteShopCategory($uuid);

        if(!$response) {
            return $this->msgResponse('Failed to delete shop category.', 500);
        }
        return $this->msgResponse('Shop category deleted successfully.', 200);
    }
}
