<?php

namespace Streams\Tests\Core\Integration\Field;

use Streams\Core\Field\Types\IntegerFieldType;
use Streams\Core\Support\Facades\Streams;
use Streams\Tests\Core\Integration\CoreTestCase;

class FieldDecoratorTest extends CoreTestCase
{
    public function test_it_can_set_and_get_field()
    {
        $field = new IntegerFieldType([
            'foo' => 'bar',
            'stream' => Streams::make('films')
        ]);

        $this->assertSame('bar', $field->decorate('100')->getField()->foo);
        $this->assertSame(100, $field->decorate(100)->getValue());
    }
}
