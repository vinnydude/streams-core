<?php

namespace Streams\Tests\Core\Integration\Support\Traits;

use Illuminate\Support\Facades\Lang;
use Streams\Tests\Core\Integration\CoreTestCase;

class TranslatorTranslateTest extends CoreTestCase
{
    public function test_it_translates_strings()
    {
        $this->assertSame('Foo Bar', Lang::translate('testing.foo_bar'));
    }

    public function test_it_translates_arrays()
    {
        $this->assertSame(['foo_bar' => 'Foo Bar'], Lang::translate([
            'foo_bar' => 'testing.foo_bar',
        ]));
    }
}
