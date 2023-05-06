<?php

namespace App\Providers;

use App\Repositories\ProductRepository;
use App\Contracts\ProductRepositoryInterface;
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
        //

        // repositories here...
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }
}
