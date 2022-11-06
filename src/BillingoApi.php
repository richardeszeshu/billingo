<?php

declare(strict_types=1);

namespace RichardEszes\Billingo;

use GuzzleHttp\Client;
use RichardEszes\Billingo\Controllers\PartnerController;
use RichardEszes\Billingo\Controllers\ProductController;
use RichardEszes\Billingo\Exceptions\BillingoException;
use RichardEszes\Billingo\Exceptions\DoesntHaveSubscriptionException;
use RichardEszes\Billingo\Exceptions\InternalServerErrorException;
use RichardEszes\Billingo\Exceptions\MalformedException;
use RichardEszes\Billingo\Exceptions\TooManyRequestsException;
use RichardEszes\Billingo\Exceptions\UnauthorizedException;
use RichardEszes\Billingo\Exceptions\ValidationErrorException;
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
    public function partner(null|Partner $partner = null): PartnerController
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
    public function product(null|Product $product = null): ProductController
    {
        $controller = new ProductController($this->client, $product);
        
        return $controller;
    }

    /**
     * Get exchange rate between two currencies.
     * 
     * @param string $from
     * @param string $to
     * @param string $date
     * @return object
     * @throws MalformedException
     * @throws UnauthorizedException
     * @throws DoesntHaveSubscriptionException
     * @throws ValidationErrorException
     * @throws TooManyRequestsException
     * @throws InternalServerErrorException
     * @throws BillingoException
     */
    public function exchangeRate(string $from, string $to, string $date = null): object
    {
        if ($date === null) {
            $date = date('Y-m-d');
        }

        if (!in_array($from, config('billingo.currencies')) || !in_array($to, config('billingo.currencies'))) {
            throw new \Exception("Invalid currency");
        }

        $response = $this->client->get(
            '/' . BillingoApi::API_VERSION . '/currencies',
            [
                'form_params' => [
                    'from' => $from,
                    'to' => $to,
                    'date' => $date
                ]
            ]
        );

        $statusCode = $response->getStatusCode();
        if ($statusCode !== 200) {
            switch ($statusCode) {
                case 400:
                    throw new MalformedException();
                    break;
                case 401:
                    throw new UnauthorizedException();
                    break;
                case 402:
                    throw new DoesntHaveSubscriptionException();
                    break;
                case 422:
                    throw new ValidationErrorException();
                    break;
                case 429:
                    throw new TooManyRequestsException();
                    break;
                case 500:
                    throw new InternalServerErrorException();
                    break;
                default:
                    throw new BillingoException("Unknown error");
                    break;
            }
        }

        return json_decode($response->getBody()->getContents());
    }

}