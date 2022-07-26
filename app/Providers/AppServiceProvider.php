<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::directive('money2', function ($amount) {
            return "<?php echo number_format($amount) . ' VND'; ?>";
        });

        Blade::directive('datetime', function ($timestamp) {
            return "<?php echo date_format($timestamp, 'Y/m/d H:i'); ?>";
        });
    }
}
