<?php

declare(strict_types=1);

namespace Makeitlv\Lavstore\Tests;

use Illuminate\Foundation\Application;
use Makeitlv\Lavstore\Providers\LavstoreServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * @param Application  $app
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [
            LavstoreServiceProvider::class
        ];
    }
}
