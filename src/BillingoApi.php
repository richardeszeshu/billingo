<?php

namespace RichardEszes\Billingo;

use GuzzleHttp\Client;
use RichardEszes\Billingo\Controllers\PartnerController;
use RichardEszes\Billingo\Controllers\ProductController;
use RichardEszes\Billingo\Models\Partner;
use RichardEszes\Billingo\Models\Product;

class BillingoApi
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var int
     */
    protected $blockId;

    /**
     * Version of current API
     */
    const API_VERSION = 'v3';

    /**
     * Create a Billingo API wrapper.
     * 
     * @param string $baseUrl
     * @param string $apiKey
     * @param int $blockId
     */
    public function __construct(string $baseUrl, string $apiKey, int $blockId) {
        $this->client = new Client([
            'base_uri' => $baseUrl,
            'headers' => [
                'X-API-KEY' => $apiKey
            ]
        ]);

        $this->blockId = $blockId;
    }

    /**
     * Get handler of partners.
     * 
     * @param null|Partner $partner
     * @return PartnerController
     */
    public function partner(null|Partner $partner = null)
    {
        $controller = new PartnerController($this->client, $partner);
        
        return $controller;
    }

    /**
     * Get handler of products.
     * 
     * @param null|Product $product
     * @return ProductController
     */
    public function product(null|Product $product = null)
    {
        $controller = new ProductController($this->client, $product);
        
        return $controller;
    }

}