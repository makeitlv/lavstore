<?php

declare(strict_types=1);

namespace Makeitlv\Lavstore\Tests\Architecture;

use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;

final class OnionArchitectureTest
{
    public function testDomainDoesNotDependOnOtherLayers(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('Makeitlv\Lavstore\Domain'))
            ->shouldNotDependOn()
            ->classes(
                Selector::inNamespace('Makeitlv\Lavstore\Application'),
                Selector::inNamespace('Makeitlv\Lavstore\Infrastructure'),
            )
            ->because('This will break our architecture, implement it another way!');
    }
}
