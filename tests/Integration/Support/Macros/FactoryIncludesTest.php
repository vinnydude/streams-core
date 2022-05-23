<?php

namespace Streams\Tests\Core\Integration\Support\Traits;

use Illuminate\Support\Facades\View;
use Streams\Tests\Core\Integration\CoreTestCase;

class FactoryIncludesTest extends CoreTestCase
{
    public function test_it_renders_view_includes()
    {
        View::include('slot', 'welcome');

        $this->assertStringContainsString('Welcome', View::includes('slot'));
    }
}
