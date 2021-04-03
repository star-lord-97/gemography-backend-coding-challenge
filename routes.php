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
    $arrayToReturn = array();
    foreach (collectLanguagesLinks() as $language => $links) {
        array_push($arrayToReturn, array(
            'language' => $language,
            'number_of_repos' => count($links),
            'list_of_repos' => $links,
        ));
    }

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode($arrayToReturn));
    return $response;
});

$request = ServerRequest::fromGlobals($_GET);

$response = $router->dispatch($request);

(new SapiEmitter)->emit($response);
