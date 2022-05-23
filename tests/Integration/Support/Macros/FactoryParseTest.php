<?php

namespace Streams\Tests\Core\Integration\Support\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;
use Streams\Tests\Core\Integration\CoreTestCase;

class FactoryParseTest extends CoreTestCase
{
    protected function tearDown(): void
    {
        $templates = storage_path('streams/default/templates');

        if (is_dir($templates)) {
            File::deleteDirectory($templates);
        }

        parent::tearDown();
    }

    public function test_it_renders_string_templates()
    {
        $view = ViewFacade::parse('Hi {{ $name }}', [
            'name' => 'Ryan',
        ]);

        $this->assertInstanceOf(View::class, $view);

        $this->assertSame('Hi Ryan', $view->render());
    }
}
