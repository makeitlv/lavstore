<?php

declare(strict_types=1);

use function Pest\Laravel\{get};

it('has a hello page', function () {
    get('/lavstore/')
        ->assertStatus(200)
        ->assertContent('Hello World');
});
