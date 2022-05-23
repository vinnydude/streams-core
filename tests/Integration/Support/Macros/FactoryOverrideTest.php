<?php

namespace Streams\Tests\Core\Integration\Support\Traits;

use Illuminate\Support\Facades\View;
use Streams\Tests\Core\Integration\CoreTestCase;

class FactoryOverrideTest extends CoreTestCase
{
    public function test_it_overrides_views()
    {
        View::override('welcome', 'resources/views/testing.blade.php');

        $content = (string) View::make('welcome');

        $this->assertStringContainsString('Testing', $content);
    }
}
