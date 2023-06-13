<?php

namespace Scrapper\Exceptions;

use ReturnTypeWillChange;

class ScrapperException extends \Exception
{
    protected $message = 'Scrapper meets an error, report this on: https://github.com/WebXScripts/Blu/issues';

    #[ReturnTypeWillChange] public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}";
    }
}
