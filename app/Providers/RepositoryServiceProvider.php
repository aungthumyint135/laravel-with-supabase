<?php

namespace App\Providers;

use App\Foundation\Repository\Eloquent\BaseRepository;
use App\Foundation\Repository\EloquentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->singleton(EloquentRepositoryInterface::class, BaseRepository::class);

        $models = [
            'ShopCategory'
        ];

        foreach ($models as $model) {
            $this->app->singleton(
                "App\Repositories\\$model\\{$model}RepositoryInterface",
                "App\Repositories\\$model\\{$model}Repository"
            );
        }
    }
}
