<?php

namespace Anomaly\Streams\Platform\Provider\Concerns;

use Anomaly\Streams\Platform\Asset\Facades\Assets;

/**
 * Trait ProvidesAssets
 *
 * @link   http://pyrocms.com/
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
trait ProvidesAssets
{

    /**
     * The named assets.
     *
     * @var array
     */
    public $assets = [];

    /**
     * Register the named assets.
     */
    protected function registerAssets()
    {
        foreach ($this->assets as $name => $assets) {
            Assets::register($name, $assets);
        }
    }
}
