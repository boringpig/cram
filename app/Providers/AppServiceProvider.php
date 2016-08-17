<?php

namespace App\Providers;

use App\Repositories\Activity\ActivityRepository;
use App\Repositories\Activity\EloquentActivity;
use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository as UserRepositoryContract;
use App\Repositories\User\EloquentUser;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
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
