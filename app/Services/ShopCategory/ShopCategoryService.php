<?php

namespace App\Services\ShopCategory;

use Illuminate\Http\Request;
use App\Services\CommonService;
use Illuminate\Support\Facades\DB;
use App\Repositories\ShopCategory\ShopCategoryRepositoryInterface;

class ShopCategoryService extends CommonService
{
    public function __construct(
        protected ShopCategoryRepositoryInterface $shopCategoryRepository
    )
    {
        //
    }

    public function getAllShopCategories(Request $request): array
    {
        $params = $this->params($request);
        $data = $this->shopCategoryRepository->all($params);
        unset($params['with'], $params['limit'], $params['offset']);
        $total = $this->shopCategoryRepository->totalCount($params);

        return ['data' => $data, 'count' => $total];
    }

    public function createShopCategory(Request $request)
    {
        $data = $this->input(
            $request->all(),
            ['name', 'description'],
            true
        );

        try {
            DB::beginTransaction();
            $shopCategory = $this->shopCategoryRepository->insert($data);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return false;
        }
        return $shopCategory;
    }

    public function getShopCategoryByUuid(string $uuid)
    {
        $shopCategory = $this->shopCategoryRepository->getDataByUuid($uuid);

        if (!$shopCategory) {
            return false;
        }

        return $shopCategory;
    }

    public function updateShopCategory(string $uuid, Request $request)
    {
        $data = $this->input(
            $request->all(),
            ['name', 'description'],
            true
        );

        $shopCategory = $this->shopCategoryRepository->getDataByUuid($uuid);

        if (!$shopCategory) {
            abort(404, 'Shop category not found.');
        }

        try {
            DB::beginTransaction();
            $this->shopCategoryRepository->update($data, $shopCategory->id);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return false;
        }
        return true;
    }

    public function deleteShopCategory(string $uuid): bool
    {
        $shopCategory = $this->shopCategoryRepository->getDataByUuid($uuid);

        if (!$shopCategory) {
            abort(404, 'Shop category not found.');
        }

        try {
            DB::beginTransaction();
            $this->shopCategoryRepository->destroy($shopCategory->id);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return false;
        }
        return true;
    }
}
