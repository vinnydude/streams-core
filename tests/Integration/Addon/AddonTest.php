<?php

namespace Streams\Tests\Core\Integration\Addon;

use Streams\Core\Support\Facades\Addons;
use Streams\Tests\Core\Integration\CoreTestCase;

class AddonTest extends CoreTestCase
{
    public function test_it_is_arrayable()
    {
        $this->assertEquals([
            'name',
            'path',
            'composer',
        ], array_keys(Addons::make('streams/testing')->toArray()));
    }

    public function test_it_is_jsonable()
    {
        $this->assertEquals([
            'name',
            'path',
            'composer',
        ], array_keys(json_decode(Addons::make('streams/testing')->toJson(), true)));
    }
}
