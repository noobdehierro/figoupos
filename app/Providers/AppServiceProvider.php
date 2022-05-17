<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        Gate::define('super', function (User $user) {
            return $user->role_id === 1;
        });

        Gate::define('admin', function (User $user) {
            return $user->role_id <= 2;
        });

        Gate::define('manager', function (User $user) {
            return $user->role_id <= 3;
        });

        Gate::define('dist', function (User $user) {
            return $user->role_id === 4;
        });

        Blade::if('super', function () {
            return request()
                ->user()
                ->can('super');
        });

        Blade::if('admin', function () {
            return request()
                ->user()
                ->can('admin');
        });

        Blade::if('manager', function () {
            return request()
                ->user()
                ->can('manager');
        });

        Blade::if('distr', function () {
            return request()
                ->user()
                ->can('distr');
        });
    }
}
