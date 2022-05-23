<?php

namespace Streams\Tests\Core\Integration\Support\Traits;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Streams\Core\Support\Facades\Streams;
use Streams\Tests\Core\Integration\CoreTestCase;

class UrlStreamsTest extends CoreTestCase
{
    public function test_it_generates_url_strings()
    {
        $stream = Streams::register([
            'id' => 'testing.url_macros',
            'routes' => [
                'view' => [
                    'uri' => 'testing/macros/{id}',
                ],
                'show' => [
                    'uri' => 'testing/macros/show/{entry.id}',
                ]
            ],
            'fields' => [
                'id' => [
                    'type' => 'uuid',
                ],
            ],
        ]);

        $entry = $stream->entries()->newInstance([
            'id' => (string) Str::uuid(),
        ]);

        $this->assertSame(
            URL::to('testing/macros/' . $entry->id),
            URL::streams('testing.url_macros.view', $entry)
        );

        $this->assertSame(
            URL::to('testing/macros/show/' . $entry->id),
            URL::streams('testing.url_macros.show', compact('entry'))
        );

        $this->assertSame(
            URL::to('foo/bar'),
            URL::streams('foo/bar', $entry)
        );
    }
}
