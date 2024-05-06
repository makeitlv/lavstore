<?php

declare(strict_types=1);

namespace Makeitlv\Lavstore\Tests\Architecture;

use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;

final class OnionArchitectureTest
{
    public function testModuleDomainDoesNotDependOnOtherLayers(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('Makeitlv\Lavstore\Module\.*\Domain'))
            ->shouldNotDependOn()
            ->classes(
                Selector::inNamespace('Makeitlv\Lavstore\Module\.*\Application'),
                Selector::inNamespace('Makeitlv\Lavstore\Module\.*\Infrastructure'),
            )
            ->because('Domain layer in all modules should not depend on other layers');
    }

    public function testModuleApplicationDependsOnlyOnDomain(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('Makeitlv\Lavstore\Module\.*\Application'))
            ->shouldNotDependOn()
            ->classes(Selector::inNamespace('Makeitlv\Lavstore\Module\.*\Infrastructure'))
            ->because('Application layer in all modules should only depend on Domain layer');
    }

    public function testModuleInfrastructureDependsOnDomainAndApplication(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('Makeitlv\Lavstore\Module\.*\Infrastructure'))
            ->canOnlyDependOn()
            ->classes(
                Selector::inNamespace('Makeitlv\Lavstore\Module\.*\Domain'),
                Selector::inNamespace('Makeitlv\Lavstore\Module\.*\Application')
            )
            ->because('Infrastructure layer in all modules should depend on Domain and Application layers');
    }

    public function testModulesCanOnlyCommunicateThroughAdapters(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('Makeitlv\Lavstore\Modules\.*'))
            ->excluding(Selector::inNamespace('Makeitlv\Lavstore\Modules\.*\Infrastructure\Adapter\.*'))
            ->shouldNotDependOn()
            ->classes(Selector::inNamespace('Makeitlv\Lavstore\Modules\.*'))
            ->because('Modules should not depend on each other, except through the Adapters');
    }
}
