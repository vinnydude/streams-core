<?php

namespace Streams\Core\Field\Type;

use Illuminate\Support\Str;
use Streams\Core\Field\FieldType;
use Streams\Core\Field\Value\StrValue;

class Slug extends FieldType
{
    public function modify($value)
    {
        if (is_null($value)) {
            return $value;
        }

        return Str::slug($value, $this->field->config('seperator') ?: '_');
    }

    public function restore($value)
    {
        if (is_null($value)) {
            return $value;
        }
        
        return Str::slug($value, $this->field->config('seperator') ?: '_');
    }

    public function expand($value)
    {
        return new StrValue($value);
    }
    
    public function generate()
    {
        return $this->modify($this->generator()->words(2, true));
    }
}