<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Define rate limiter called login
        RateLimiter::for('limiter', function (Request $request) {
            // Create a new rate limit rule:
            return Limit::perMinute(3)
                ->by(
                    // Identify users by their ID if logged in, otherwise use their IP address
                    optional($request->user())->id ?: $request->ip()
                );
            // the 'by' method determines how to identify unique users
            // we use optional method to prevent against null pointer errors if user is null
        });

        
        Route::middleware(['api', 'throttle:limiter'])  // Changed to include both api middleware and throttle
            ->prefix('api')
            ->group(base_path('routes/api.php'));

        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }
}
