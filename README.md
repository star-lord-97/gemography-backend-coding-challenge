# gemography-backend-coding-challenge

## /github/languages

-   sending GET request to "https://api.github.com/search/repositories?q=created:>{today's date}&sort=stars&order=desc&per_page=100" to get the trending repos from the last 30 days.
-   decoding the JSON response body to a normal php associative array and removing the metadata from it leaving only an array of repositories data.
-   from each repository collecting only it's 'language' and 'html_url' properties and pushing them to a new associative array.
-   encoding the resulting array to JSON and attaching it to the body of the response of a GET request to '/github/languages' URI.

## notes

-   I could've achieved the same result easily using Laravel but I thought it'd be an overkill tbh, so I just used pure php with the aid of some popular packages, and also learned a thing or two about routing along the way.
-   packages used: 'guzzlehttp/guzzle' to send the initial request to the github API and also to create the response of the newly created URI requests, 'league/route' to manage the implementation of the HTTP messages, and 'laminas/laminas-httphandlerrunner' to emit the response created by guzzle.
-   sorry for making the base URI [/gemography-backend-coding-challenge] that long :"D
