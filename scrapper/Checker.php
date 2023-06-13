<?php

namespace Scrapper;

use Scrapper\Abstract\Method;
use Scrapper\DTO\Response;
use Scrapper\Exceptions\MethodNotFoundException;
use Scrapper\Exceptions\ScrapperException;
use Scrapper\Http\Http;

final readonly class Checker
{
    public function __construct(
        private Method $method
    ) {}

    /**
     * This method is used to set the method to check the server status.
     * @param string $method
     * @return Checker
     * @throws MethodNotFoundException
     * @throws ScrapperException
     */
    public static function setMethod(string $method = Http::class): self
    {
        if(self::methodExists($method)) {
            return new self(new $method());
        }

        throw new ScrapperException();
    }

    /**
     * This method is used to check if the server is online or not.
     * @param string $url
     * @return Response
     */
    public function check(string $url): Response
    {
        return $this->method->status($url);
    }

    /**
     * This method is used to check if the method exists or not.
     * @param string $method
     * @return bool
     * @throws MethodNotFoundException
     */
    private static function methodExists(string $method): true
    {
        if(!class_exists($method)) {
            throw new MethodNotFoundException($method);
        }
        return true;
    }
}
