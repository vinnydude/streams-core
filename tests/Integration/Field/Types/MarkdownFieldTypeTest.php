<?php

namespace Streams\Tests\Core\Integration\Field\Types;

use Streams\Core\Field\Decorator\MarkdownDecorator;
use Streams\Core\Field\Types\MarkdownFieldType;
use Streams\Core\Support\Facades\Streams;
use Streams\Tests\Core\Integration\CoreTestCase;

class MarkdownFieldTypeTest extends CoreTestCase
{
    public function test_it_returns_markdown_decorator()
    {
        $field = new MarkdownFieldType([
            'stream' => Streams::make('films'),
        ]);

        $this->assertInstanceOf(MarkdownDecorator::class, $field->decorate('markdown'));
    }
}
