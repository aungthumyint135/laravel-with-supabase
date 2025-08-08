<?php

namespace App\Services;

use Illuminate\Http\Request;

class CommonService
{

    protected int $offset = 0;

    protected int $limit = 10;

    public function input(array $data, array $fillable, bool $allowNull = false): array
    {
        return $allowNull ? array_intersect_key($data, array_flip($fillable)) :
            array_filter(array_intersect_key($data, array_flip($fillable)), fn ($value) => $value != null);
    }

    public function params(Request $request, array $only = [], array $options = []): array
    {
        $search = $data['search'] ?? null;

        $params = [
            'search' => ! empty($search) && is_string($search) ? $search : null,
            'limit' => ! empty($data['limit']) ? (int) $data['limit'] : $this->limit,
            'offset' => ! empty($data['offset']) ? (int) $data['offset'] : $this->offset,
        ];

        if (isset($data['status']) && empty($options['status'])) {
            $params['status'] = $data['status'];
        }

        if (! empty($only)) {
            $params = array_intersect_key($params, array_flip($only));
        }

        if (! empty($options)) {
            $params = array_merge($params, $options);
        }

        return $params;
    }
}
