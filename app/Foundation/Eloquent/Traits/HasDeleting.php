<?php

namespace App\Foundation\Eloquent\Traits;

trait HasDeleting
{
    public static function boot()
    {
        parent::boot();

        self::deleting(function ($model) {

            if (method_exists($model, 'childRelation') &&
                is_callable([$model, 'childRelation'])) {

                $model->childRelation()->delete();
            }

            if (method_exists($model, 'multiLangs') &&
                is_callable([$model, 'multiLangs'])) {

                $model->multiLangs()->delete();
            }

            $model->update(['deleted_by' => auth('admins')->id()]);
        });
    }
}
