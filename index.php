<?php

require 'vendor/autoload.php';
require 'helpers.php';

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$client = new Client();
$uri = formatURI();
$response = $client->request('GET', $uri);
$repositories = decodeAndRemoveMetadata($response->getBody());

$router = new Router();

$router->get('/gemography-backend-coding-challenge/github', function (ServerRequestInterface $request): ResponseInterface {
    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode(array('name' => 'Ahmed')));
    return $response;
});

$request = ServerRequest::fromGlobals($_GET);

$response = $router->dispatch($request);

(new SapiEmitter)->emit($response);
