<?php

namespace Streams\Tests\Core\Integration\Appilcation;

use Streams\Core\Support\Facades\Applications;
use Streams\Tests\Core\Integration\CoreTestCase;

class ApplicationTest extends CoreTestCase
{

    public function test_applications_are_arrayable()
    {
        $this->assertEquals([
            'id',
            'match',
        ], array_keys(Applications::make('default')->toArray()));
    }

    public function test_applications_are_jsonable()
    {
        $this->assertEquals([
            'id',
            'match',
        ], array_keys(json_decode(Applications::make('default')->toJson(), true)));
    }
}
