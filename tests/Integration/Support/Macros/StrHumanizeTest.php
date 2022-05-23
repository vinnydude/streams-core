<?php

namespace Streams\Tests\Core\Integration\Support\Traits;

use Illuminate\Support\Str;
use Streams\Tests\Core\Integration\CoreTestCase;

class StrHumanizeTest extends CoreTestCase
{

    public function test_it_humanizes_strings()
    {
        $this->assertSame('foo bar', Str::humanize('foo_bar'));
        $this->assertSame('foo bar', Str::humanize('foo-bar', '-'));
    }
}
