<?php

namespace App\Repositories\ShopCategory;

use App\Foundation\Repository\Eloquent\BaseRepository;
use App\Models\ShopCategory\ShopCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ShopCategoryRepository extends BaseRepository implements ShopCategoryRepositoryInterface
{

    public function connection(): Model
    {
        return new ShopCategory();
    }

    public function optionsQuery(array $options): Builder
    {
        $query = parent::optionsQuery($options);

        if (! empty($options['search'])) {
            $query->where('name', 'like', "%{$options['search']}%");
        }

        if (isset($options['status'])) {
            $query->where('status', $options['status']);
        }

        return $query;
    }
}
