<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }

        Blade::directive('naira', function ($amount) {
            return "<?= '₦'. number_format($amount,2);?>";
        });
    }

    /**
     * Register any application services.
     */
    public function register()
    {
    }
}
