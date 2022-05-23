<?php

namespace Streams\Tests\Core\Integration\Image;

use Streams\Core\Image\ImageRegistry;
use Streams\Tests\Core\Integration\CoreTestCase;

class ImageRegistryTest extends CoreTestCase
{

    public function test_it_registers_images_by_name()
    {
        $registry = new ImageRegistry;

        $registered = 'public::vendor/core/tests/logo.png';

        $registry->register('logo.png', $registered);

        $this->assertEquals($registered, $registry->resolve('logo.png'));
    }
}
