<?php

namespace App\Providers;

use App\Contracts\FileExternalServiceInterface;
use App\Contracts\StorageServiceInterface;
use App\Services\StorageService;
use App\Services\TinyImageCropService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FileExternalServiceInterface::class, TinyImageCropService::class);
        $this->app->bind(StorageServiceInterface::class, StorageService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        JsonResource::withoutWrapping();
    }
}
