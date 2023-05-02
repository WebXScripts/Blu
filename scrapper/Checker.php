<?php

namespace Scrapper;

use Scrapper\Abstract\Method;
use Scrapper\DTO\Response;
use Scrapper\Exceptions\MethodNotFoundException;

final class Checker
{
    private static Method $method;

    /**
     * This method is used to set the method to check the server status.
     * @param string $method
     * @return Checker|null
     * @throws MethodNotFoundException
     */
    public static function setMethod(string $method): ?self
    {
        if(self::methodExists($method)) {
            self::$method = new $method();
            return new self();
        }

        return null;
    }

    /**
     * This method is used to check if the server is online or not.
     * @param string $url
     * @return Response
     */
    public function check(string $url): Response
    {
        return self::$method->status($url);
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
