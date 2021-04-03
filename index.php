<?php

require 'vendor/autoload.php';
require 'helpers.php';

use GuzzleHttp\Client;

$client = new Client();
$uri = formatURI();
$response = $client->request('GET', $uri);
$repositories = decodeAndRemoveMetadata($response->getBody());

echo '<pre>';
print_r($repositories);
echo '</pre>';
