<?php

namespace Scrapper\Exceptions;

use ReturnTypeWillChange;

class MethodNotFoundException extends \Exception
{
    public function __construct(string $method)
    {
        parent::__construct("Method {$method} does not exist.");
    }

    #[ReturnTypeWillChange] public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}";
    }
}
