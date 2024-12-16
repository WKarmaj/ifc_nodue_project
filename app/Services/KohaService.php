<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class KohaService
{
    protected $client;
    protected $kohaUrl;

    public function __construct()
    {
        $this->kohaUrl = config('services.koha.base_url'); // Use environment variable for base URL
        $this->client = new Client([
            'auth' => [config('services.koha.username'), config('services.koha.password')], // Use environment variables for credentials
            'timeout' => 10.0,
        ]);
    }

    /**
     * Fetch the due data for a patron from Koha.
     *
     * @param string $patronId
     * @return array
     */
    public function getPatronDues($patronId)
    {
        $endpoint = "{$this->kohaUrl}/checkouts";
    
        try {
            $response = $this->client->request('GET', $endpoint, [
                'query' => ['patron_id' => $patronId],
            ]);
    
            $data = json_decode($response->getBody()->getContents(), true);
    
            if (!is_array($data)) {
                return ['error' => 'Invalid response from Koha API.'];
            }
    
            return $data;
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if ($response && $response->getStatusCode() === 500) {
                return ['error' => 'Koha API internal server error.'];
            }
            return ['error' => 'Unable to fetch data from Koha: ' . $e->getMessage()];
        }
    }
    
}
