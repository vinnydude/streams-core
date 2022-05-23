<?php

namespace Streams\Tests\Core\Integration\Field\Types;

use Streams\Core\Field\Decorator\BooleanDecorator;
use Streams\Core\Field\Types\BooleanFieldType;
use Streams\Core\Support\Facades\Streams;
use Streams\Tests\Core\Integration\CoreTestCase;

class BooleanFieldTypeTest extends CoreTestCase
{
    public function test_it_returns_boolean_value()
    {
        $field = new BooleanFieldType([
            'stream' => Streams::make('films')
        ]);

        $this->assertInstanceOf(BooleanDecorator::class, $field->decorate(true));
    }

    public function test_it_casts_to_boolean()
    {
        $field = new BooleanFieldType([
            'stream' => Streams::make('films')
        ]);

        $this->assertSame(true, $field->cast('yes'));
        $this->assertSame(true, $field->modify('yes'));
        $this->assertSame(true, $field->restore('yes'));
    }
}
