<?php

namespace Streams\Core\Tests\Field\Type;

use Tests\TestCase;
use Streams\Core\Field\Value\ColorValue;
use Streams\Core\Support\Facades\Streams;

class ColorTest extends TestCase
{

    public function setUp(): void
    {
        $this->createApplication();

        Streams::load(base_path('vendor/streams/core/tests/litmus.json'));
        Streams::load(base_path('vendor/streams/core/tests/fakers.json'));
    }

    public function test_forces_lowercase()
    {
        $type = Streams::make('testing.litmus')->fields->color->type();

        $this->assertSame('#ffffff', $type->cast('#FFFFFF'));
    }

    public function test_expanded_value()
    {
        $test = Streams::repository('testing.litmus')->find('field_types');

        $this->assertInstanceOf(ColorValue::class, $test->expand('color'));
    }

    public function test_can_generate_value()
    {
        $stream = Streams::make('testing.fakers');

        $color = substr($stream->fields->color->type()->generate(), 1);

        $this->assertTrue(ctype_xdigit($color) && strlen($color) == 6);
    }
}
