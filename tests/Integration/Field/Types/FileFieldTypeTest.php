<?php

namespace Streams\Tests\Core\Integration\Field\Types;

use Streams\Core\Field\Decorator\FileDecorator;
use Streams\Core\Field\Types\FileFieldType;
use Streams\Core\Support\Facades\Streams;
use Streams\Tests\Core\Integration\CoreTestCase;

class FileFieldTypeTest extends CoreTestCase
{
    public function test_it_casts_to_file_location()
    {
        $field = new FileFieldType([
            'stream' => Streams::make('films')
        ]);

        $this->assertSame('', $field->cast(''));
    }

    public function test_it_returns_file_decorator()
    {
        $field = new FileFieldType([
            'stream' => Streams::make('films')
        ]);

        $this->assertInstanceOf(FileDecorator::class, $field->decorate(''));
    }
}
