<?php

namespace Streams\Core\Field\Types;

use Streams\Core\Field\Field;
use Streams\Core\Field\Schema\StringSchema;
use Streams\Core\Field\Decorator\ColorDecorator;

class ColorFieldType extends Field
{
    public function cast($value): string
    {
        return strtolower((string) $value);
    }

    public function modify($value)
    {
        return $this->cast($value);
    }

    public function restore($value)
    {
        return $this->cast($value);
    }

    public function getSchemaName()
    {
        return StringSchema::class;
    }
    
    public function getDecoratorName()
    {
        return ColorDecorator::class;
    }

    // public function generate()
    // {
    //     return '#' . str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
    // }
}
