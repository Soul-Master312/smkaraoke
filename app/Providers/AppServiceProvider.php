<?php

namespace App\Providers;

use App\Http\Repositories\Contracts\AuthApiRepositoryInterface;
use App\Http\Repositories\Contracts\FirebaseApiRepositoryInterface;
use App\Http\Repositories\Contracts\RoomApiRepositoryInterface;
use App\Http\Repositories\Eloquent\AuthApiRepository;
use App\Http\Repositories\Eloquent\FirebaseApiRepository;
use App\Http\Repositories\Eloquent\RoomApiRepository;
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
        $this->app->singleton(
            RoomApiRepositoryInterface::class,
            RoomApiRepository::class
        );
        $this->app->singleton(
            AuthApiRepositoryInterface::class,
            AuthApiRepository::class
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
