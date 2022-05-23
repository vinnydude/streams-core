<?php

namespace Streams\Tests\Core\Integration\Addon;

use Illuminate\Support\Collection;
use Streams\Core\Addon\Addon;
use Streams\Core\Support\Facades\Addons;
use Streams\Tests\Core\Integration\CoreTestCase;

class AddonManagerTest extends CoreTestCase
{
    public function test_it_loads_an_addon_by_path()
    {
        Addons::load('vendor/streams/testing');

        $addon = Addons::make('streams/testing');

        $this->assertInstanceOf(Addon::class, $addon);
    }

    public function test_it_returns_registered_addons()
    {
        $addons = Addons::collection();

        $this->assertInstanceOf(Collection::class, $addons);
    }
}
