<?php

namespace Streams\Tests\Core\Integration\Support\Macros;

use Illuminate\Support\Arr;
use Streams\Tests\Core\Integration\CoreTestCase;

class ArrExportTest extends CoreTestCase
{
    public function test_it_exports_arrays()
    {
        $this->assertEquals("[
    'foo' => 'bar',
]", Arr::export(['foo' => 'bar']));
    }
}
