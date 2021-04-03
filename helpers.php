<?php

use GuzzleHttp\Client;

/**
 * goBack30Days:
 * helper function that returns the date of the
 * day -30 days from current day in the required format
 *
 * @return string
 */
function goBack30Days(): string
{
    $date = new DateTime();
    $date = $date->sub(new DateInterval('P30D'));
    return $date->format('Y-m-d');
}

/**
 * formatURI:
 * helper function that returns the uri with the
 * correct date to use in the request
 *
 * @return string
 */
function formatURI(): string
{
    $date = goBack30Days();
    return 'https://api.github.com/search/repositories?q=created:>' . $date . '&sort=stars&order=desc&per_page=100';
}

/**
 * decodeAndRemoveMetadata:
 * helper function that receives json string,
 * converts it into an associative array and
 * removes the metadata then returns it
 *
 * @param  mixed $jsonData
 * @return array
 */
function decodeAndRemoveMetadata($jsonData): array
{
    $rawDecodedData = json_decode($jsonData, true);
    return $rawDecodedData['items'];
}

/**
 * getRepos:
 * sends a GET request, receives it's response,
 * format and decode it then returns it
 * 
 * @return array
 */
function getRepos(): array
{
    $client = new Client();
    $uri = formatURI();
    $response = $client->request('GET', $uri);
    $repositories = decodeAndRemoveMetadata($response->getBody());
    return $repositories;
}

/**
 * collectLanguagesLinks:
 * loops through each repository grabbing only
 * it's link and saves it in an associative array
 * with the index of the language name, then
 * returns the new associative array
 * 
 * @return array
 */
function collectLanguagesLinks(): array
{
    $repositories = getRepos();
    $languagesLinks = array();

    foreach ($repositories as $repository) {
        if (array_key_exists($repository['language'], $languagesLinks))
            array_push($languagesLinks[$repository['language']], $repository['html_url']);
        else {
            $languagesLinks[$repository['language']] = array();
            array_push($languagesLinks[$repository['language']], $repository['html_url']);
        }
    }

    return $languagesLinks;
}
