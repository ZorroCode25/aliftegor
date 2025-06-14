<?php

namespace App\Providers;

use App\Models\Guardian;
use App\Models\User;
use App\Observers\GuardianObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            LoginResponse::class,
            \App\Http\Responses\LoginResponse::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Guardian::observe(GuardianObserver::class);
    }
}
