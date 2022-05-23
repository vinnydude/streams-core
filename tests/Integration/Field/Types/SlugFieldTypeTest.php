<?php

namespace Streams\Tests\Core\Integration\Field\Types;

use Streams\Core\Field\Decorator\StringDecorator;
use Streams\Core\Field\Types\SlugFieldType;
use Streams\Core\Support\Facades\Streams;
use Streams\Tests\Core\Integration\CoreTestCase;

class SlugFieldTypeTest extends CoreTestCase
{
    public function test_it_casts_to_slug_string()
    {
        $field = new SlugFieldType([
            'stream' => Streams::make('films'),
            'config' => [
                'type' => '_',
            ],
        ]);

        $this->assertSame('test_slug', $field->modify('Test Slug'));
        $this->assertSame('test_slug', $field->restore('Test Slug'));
    }

    public function test_it_returns_string_value()
    {
        $field = new SlugFieldType([
            'stream' => Streams::make('films')
        ]);

        $this->assertInstanceOf(StringDecorator::class, $field->decorate('example'));
    }
}
