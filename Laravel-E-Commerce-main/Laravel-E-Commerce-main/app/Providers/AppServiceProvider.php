<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryOption\CategoryOptionRepositoryInterface;
use App\Repositories\CategoryOption\CategoryOptionRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\CategoryRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        // $this->app->singleton(
        //     \App\Repositories\Category\CategoryRepositoryInterface::class,
        //     \App\Repositories\Category\CategoryRepository::class
        // );
        $this->app->singleton(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->singleton(CategoryOptionRepositoryInterface::class, CategoryOptionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
