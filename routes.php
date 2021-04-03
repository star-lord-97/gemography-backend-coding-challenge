<?php

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use function GuzzleHttp\json_encode;

$router = new Router();

$router->get('/gemography-backend-coding-challenge/github', function (ServerRequestInterface $request): ResponseInterface {
    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode(array('name' => 'Ahmed')));
    return $response;
});

$request = ServerRequest::fromGlobals($_GET);

$response = $router->dispatch($request);

(new SapiEmitter)->emit($response);
