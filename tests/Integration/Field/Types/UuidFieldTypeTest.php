<?php

namespace Streams\Tests\Core\Integration\Field\Types;

use Illuminate\Support\Str;
use Streams\Core\Field\Decorator\StringDecorator;
use Streams\Core\Field\Types\UuidFieldType;
use Streams\Core\Support\Facades\Streams;
use Streams\Tests\Core\Integration\CoreTestCase;

class UuidFieldTypeTest extends CoreTestCase
{
    public function test_it_returns_default_value()
    {
        $field = new UuidFieldType([
            'stream' => Streams::make('films')
        ]);

        $this->assertIsString($field->default(true));
    }

    public function test_it_returns_string_value()
    {
        $field = new UuidFieldType([
            'stream' => Streams::make('films')
        ]);

        $this->assertInstanceOf(
            StringDecorator::class,
            $field->decorate((string) Str::uuid())
        );
    }
}
