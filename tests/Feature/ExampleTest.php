<?php

declare(strict_types=1);

namespace Makeitlv\Lavstore\Tests\Feature;

use Makeitlv\Lavstore\Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testTheApplicationReturnsASuccessfulResponse(): void
    {
        $response = $this->get('/lavstore/');

        $response->assertStatus(200);
        $response->assertContent('Hello World');
    }
}
