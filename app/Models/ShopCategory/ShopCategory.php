<?php

namespace App\Models\ShopCategory;


use App\Foundation\Eloquent\Model;

class ShopCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
