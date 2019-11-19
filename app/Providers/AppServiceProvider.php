<?php

namespace App\Providers;

use App\Adapter\IJsonReader;
use App\Adapter\Implementation\JsonReader;
use App\Filters\IFilterUsers;
use App\Filters\Implementations\FilterUsers;
use App\Service\Implementation\UserService;
use App\Service\IUserService;
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
        $this->app->bind(IUserService::class,UserService::class);
        $this->app->bind(IJsonReader::class,JsonReader::class);
        $this->app->bind(IFilterUsers::class,FilterUsers::class);
    }
}
