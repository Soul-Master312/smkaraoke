<?php

namespace App\Providers;

use App\Http\Repositories\Contracts\FirebaseApiRepositoryInterface;
use App\Http\Repositories\Eloquent\FirebaseApiRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(
            FirebaseApiRepositoryInterface::class,
            FirebaseApiRepository::class
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
