<?php

namespace Scrapper\Abstract;

use Scrapper\DTO\Response;
use Scrapper\Http\Codes;

abstract class Method
{
    /**
     * This method is used to check if the server is online or not.
     * @param string $url
     * @return Codes
     */
    abstract public function status(string $url): Response;
}
