<?php

namespace SMartins\PassportMultiauth\Facades;

use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Request;

class ServerRequest
{
    /**
     * @param Request $symfonyRequest
     * @return \Psr\Http\Message\RequestInterface|\Psr\Http\Message\ServerRequestInterface
     */
    public static function createRequest(Request $symfonyRequest)
    {
        if (class_exists(PsrHttpFactory::class)) {
            $psr17Factory = new Psr17Factory;
            
            return (new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory))
                ->createRequest($symfonyRequest);
        }
        
        throw new Exception('Unable to resolve PSR request. Please install symfony/psr-http-message-bridge and nyholm/psr7.');
    }
}
