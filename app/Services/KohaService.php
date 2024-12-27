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
        $this->kohaUrl = config('services.koha.base_url');
        $this->client = new Client([
            'auth' => [config('services.koha.username'), config('services.koha.password')],
            'timeout' => 10.0,
        ]);
    }

    /**
     * Fetch patron's checkout dues from Koha system.
     *
     * @param string $patronId
     * @return array
     */
    public function getPatronDues($patronId)
    {
        $endpoint = "{$this->kohaUrl}/patrons"; // Replace with the actual Koha endpoint
        try {
            $response = $this->client->request('GET', $endpoint, [
                'query' => ['patron_id' => $patronId],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            // Adjust response structure as needed
            if (!isset($data['checkouts'])) {
                return ['error' => 'No checkout data found for this student.'];
            }

            return $data['checkouts']; // Assuming dues are in the `checkouts` field
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
