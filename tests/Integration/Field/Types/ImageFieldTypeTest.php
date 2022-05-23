<?php

namespace Streams\Tests\Core\Integration\Field\Types;

use Streams\Core\Field\Decorator\ImageDecorator;
use Streams\Core\Field\Types\ImageFieldType;
use Streams\Core\Support\Facades\Streams;
use Streams\Tests\Core\Integration\CoreTestCase;

class ImageFieldTypeTest extends CoreTestCase
{
    public function test_it_returns_image_decorator()
    {
        $field = new ImageFieldType([
            'stream' => Streams::make('films')
        ]);

        $this->assertInstanceOf(ImageDecorator::class, $field->decorate(''));
    }
}
