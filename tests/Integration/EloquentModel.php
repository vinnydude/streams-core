<?php

namespace Streams\Tests\Core\Integration;

use Illuminate\Database\Eloquent\Model;
use Streams\Core\Entry\Contract\EntryInterface;
use Streams\Core\Support\Traits\Streams;

class EloquentModel extends Model implements EntryInterface
{
    use Streams;

    public $stream = 'films';
}
