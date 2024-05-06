<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Makeitlv\Lavstore\Module\Product\Infrastructure\Controller\MainController;

Route::prefix(config('lavstore.url.prefix'))->group(function () {
    Route::get('/', [MainController::class, 'index']);
});
