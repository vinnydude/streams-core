<?php

namespace Streams\Tests\Core\Integration\Support\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Streams\Tests\Core\Integration\CoreTestCase;

class StrParseTest extends CoreTestCase
{
    public function test_it_parses_strings()
    {
        $this->assertSame(URL::to(''), Str::parse('{request.url}'));
        $this->assertSame(App::getLocale(), Str::parse('{app.locale}'));
    }
}
