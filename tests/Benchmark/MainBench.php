<?php

namespace Streams\Tests\Core\Benchmark;

class MainBench
{
    /**
     * @Revs(100)
     * @Iterations(2)
     */
    public function benchBootstrap()
    {
        /** @var \Illuminate\Foundation\Application $app */
        $app = require \Streams\Testing\TestCase::applicationBasePath().'/bootstrap/app.php';

        /** @var \Illuminate\Contracts\Console\Kernel $kernel */
        $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

        $kernel->bootstrap();
    }

}
