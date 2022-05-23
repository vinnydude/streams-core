<?php

namespace Streams\Tests\Core\Integration;

use Streams\Core\StreamsServiceProvider;
use Streams\Testing\TestCase;

abstract class CoreTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [StreamsServiceProvider::class];
    }
}
