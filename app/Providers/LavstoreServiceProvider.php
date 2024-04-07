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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }
}
