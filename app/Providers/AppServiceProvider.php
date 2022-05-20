<?php

namespace App\Providers;

use App\Contracts\FileExternalServiceInterface;
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
        //
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
        $this->app->bind(FileExternalServiceInterface::class, TinyImageCropService::class);
    }
}