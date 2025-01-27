<?php

namespace Streams\Core\Field\Decorator;

use Collective\Html\HtmlFacade;

class EmailDecorator extends StringDecorator
{
    public function mailto(
        $title = null,
        $attributes = [],
        $default = null,
        $escape = true
    ): string {

        $email = $default ?: $this->value;

        if (!$title) {
            $title = $email;
        }

        return HtmlFacade::mailto($email, $title, $attributes, $escape);
    }

    public function __toString()
    {
        return (string) $this->mailto();
    }
}
