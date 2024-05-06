<?php

declare(strict_types=1);

namespace Makeitlv\Lavstore\Providers;

use Illuminate\Support\ServiceProvider;

final class LavstoreServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/lavstore.php', 'lavstore'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/lavstore.php' => config_path('lavstore'),
        ]);

        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }
}
