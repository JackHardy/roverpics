<?php

namespace App\Services;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class NasaApiService
{
    protected $client;

    public function __construct()
    {
        // Initialize GuzzleHTTP client with base URI and default headers
        $this->client = new Client([
            'base_uri' => 'https://api.nasa.gov',
            'headers' => [
                'Accept' => 'application/json', // Accept JSON responses
            ],
            'timeout' => 10,
            'retry_on_status' => [500, 502, 503, 504], // Retry on certain HTTP status codes
            'handler' => $this->getHandlerStack(), // Set handler stack for retries
        ]);
    }

    protected function getHandlerStack(): HandlerStack
    {
        // Method to configure GuzzleHTTP HandlerStack for retries
        $stack = HandlerStack::create();
        // Push retry middleware onto the handler stack
        $stack->push(Middleware::retry($this->retryDecider(), $this->retryDelay()));

        return $stack;
    }

    protected function retryDecider(): Closure
    {
        // Retry decision logic
        return function (
            $retries,
            Request $request,
            Response $response = null,
            RequestException $exception = null
        ) {
            // Maximum number of retries
            if ($retries >= 3) {
                return false;
            }

            // Retry on server errors (5xx)
            if ($exception instanceof RequestException && $response && $response->getStatusCode() >= 500) {
                return true;
            }

            return false;
        };
    }

    protected function retryDelay(): Closure
    {
        // Retry delay logic
        return function ($numberOfRetries) {
            return 1000 * $numberOfRetries; // Milliseconds
        };
    }

    public function makeRequest($method, $uri, $options = []): ?string
    {
        // Method to make API requests
        try {
            // Make the request using the configured GuzzleHTTP client
            $response = $this->client->request($method, $uri, $options);
            // Return the response body content
            return $response->getBody()->getContents();
        } catch (RequestException $e) {
            // Catch any request exceptions
            return null;
        }
    }
}
