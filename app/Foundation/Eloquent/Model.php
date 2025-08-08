<?php

namespace App\Foundation\Eloquent;

use App\Foundation\Eloquent\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model as LaravelModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Model extends LaravelModel
{
    use HasUUID, SoftDeletes;

    protected $hidden = [
        'deleted_at',
    ];
}
