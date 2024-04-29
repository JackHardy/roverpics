<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\NasaApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetRoverPicturesController extends Controller
{
    protected $nasaApiService;

    public function __construct(NasaApiService $nasaApiService)
    {
        $this->nasaApiService = $nasaApiService;
    }

    public function __invoke(Request $request): JsonResponse
    {
        // Define the URI for the NASA API endpoint
        $uri = '/mars-photos/api/v1/rovers/curiosity/photos';

        // Define the HTTP method for the request
        $method = 'GET';

        // Define the options for the request
        $options = [
            'query' => [
                'sol' => '1000',
                'api_key' => config('services.nasa.api_key'), // API key obtained from config which pulls from env
            ],
        ];

        // Make the request to the NASA API using the configured service
        $response = $this->nasaApiService->makeRequest($method, $uri, $options);

        // Check if the response is successful
        if ($response) {
            // If successful, return the response as JSON with a 200 status code
            return response()->json($response, 200);
        } else {
            // If there's an error or the response is empty, return an error JSON with a 500 status code
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
