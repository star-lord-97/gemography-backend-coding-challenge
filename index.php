<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();
$date = new DateTime();
$date = $date->sub(new DateInterval('P30D'));
$date = $date->format('Y-m-d');
$uri = 'https://api.github.com/search/repositories?q=created:>' . $date . '&sort=stars&order=desc&per_page=100';
$response = $client->request('GET', $uri);
$rawDecodedData = json_decode($response->getBody(), true);
$repositories = $rawDecodedData['items'];
echo '<pre>';
print_r($repositories);
echo '</pre>';
