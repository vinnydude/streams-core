<?php

namespace Streams\Tests\Core\Integration\Support\Traits;

use Illuminate\Support\Facades\View;
use Streams\Core\Support\Facades\Includes;
use Streams\Tests\Core\Integration\CoreTestCase;

class FactoryIncludeTest extends CoreTestCase
{
    public function test_it_registers_view_includes()
    {
        View::include('slot', 'welcome');

        $this->assertTrue(Includes::get('slot')->contains('welcome'));
    }
}
