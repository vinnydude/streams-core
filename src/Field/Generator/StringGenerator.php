<?php

namespace Streams\Core\Field\Generator;

use Streams\Core\Field\FieldGenerator;

class StringGenerator extends FieldGenerator
{
    public function generate()
    {
        return $this->faker->text($this->field->config('max'));
    }
}
