<?php

namespace RichardEszes\Billingo;

use GuzzleHttp\Client;
use RichardEszes\Billingo\Controllers\PartnerController;
use RichardEszes\Billingo\Controllers\ProductController;
use RichardEszes\Billingo\Models\Partner;
use RichardEszes\Billingo\Models\Product;

class BillingoApi
{
    public function __construct(
        public string $baseUrl,
        public string $apiKey,
        public int $blockId){}

    public function partner(null|Partner $partner = null)
    {
        $client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'X-API-KEY' => $this->apiKey
            ]
        ]);
        $controller = new PartnerController($client, $partner);
        
        return $controller;
    }

    public function product(null|Product $product = null)
    {
        $client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'X-API-KEY' => $this->apiKey
            ]
        ]);
        $controller = new ProductController($client, $product);
        
        return $controller;
    }

    /**
     * @param array $params
     * @return object
     */
    public function getDocuments($params = []): object
    {
        $client = new Client();

        $response = $client->get($this->endpoint . '/documents', [
            'headers' => [
                'X-API-KEY' => $this->apiKey
            ],
            'form_params' => $params
        ]);

        return json_decode($response->getBody()->getContents());
    }
}