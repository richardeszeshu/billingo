<?php

namespace RichardEszes\Billingo;

use GuzzleHttp\Client;
use RichardEszes\Billingo\Exceptions\BillingoException;
use RichardEszes\Billingo\Exceptions\DoesntHaveAccessToResourceException;
use RichardEszes\Billingo\Exceptions\DoesntHaveSubscriptionException;
use RichardEszes\Billingo\Exceptions\InternalServerErrorException;
use RichardEszes\Billingo\Exceptions\NonExistentResourceException;
use RichardEszes\Billingo\Exceptions\TooManyRequestException;
use RichardEszes\Billingo\Exceptions\UnauthorizedException;
use RichardEszes\Billingo\Exceptions\ValidationErrorException;
use RichardEszes\Billingo\Models\Partner;

class BillingoApi
{
    public function __construct(
        public string $endpoint,
        public string $apiKey,
        public int $blockId){}

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

    public function listPartners($params = []): array
    {
        $client = new Client();

        $response = $client->get($this->endpoint . '/partners', [
            'headers' => [
                'X-API-KEY' => $this->apiKey
            ],
            'form_params' => $params
        ]);

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
                    throw new TooManyRequestException();
                    break;
                case 500:
                    throw new InternalServerErrorException();
                    break;
                default:
                    throw new BillingoException("Unknown error");
                    break;
            }
        }

        $result = [];
        $partners = json_decode($response->getBody()->getContents())->data;
        foreach ($partners as $row) {
            $partner = new Partner();
            $partner->loadFromResponse($row);
            $result[] = $partner;
        }

        return $result;
    }

    public function createPartner(Partner $partner): Partner
    {
        $client = new Client();

        $response = $client->post($this->endpoint . '/partners', [
            'headers' => [
                'X-API-KEY' => $this->apiKey,
                'Content-type' => 'application/json'
            ],
            'body' => json_encode($partner->toArray())
        ]);

        $statusCode = $response->getStatusCode();
        if ($statusCode !== 201) {
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
                case 403:
                    throw new DoesntHaveAccessToResourceException();
                    break;
                case 422:
                    throw new ValidationErrorException();
                    break;
                case 429:
                    throw new TooManyRequestException();
                    break;
                case 500:
                    throw new InternalServerErrorException();
                    break;
                default:
                    throw new BillingoException("Unknown error");
                    break;
            }
        }

        $result = new Partner();
        $result->loadFromResponse(json_decode($response->getBody()->getContents()));

        return $result;
    }

    public function getPartner(int $partnerId): Partner
    {
        $client = new Client();

        $response = $client->get($this->endpoint . '/partners/' . $partnerId, [
            'headers' => [
                'X-API-KEY' => $this->apiKey
            ]
        ]);

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
                case 404:
                    throw new NonExistentResourceException();
                    break;
                case 422:
                    throw new ValidationErrorException();
                    break;
                case 429:
                    throw new TooManyRequestException();
                    break;
                case 500:
                    throw new InternalServerErrorException();
                    break;
                default:
                    throw new BillingoException("Unknown error");
                    break;
            }
        }

        $result = new Partner();
        $result->loadFromResponse(json_decode($response->getBody()->getContents()));

        return $result;
    }

    public function updatePartner(Partner $partner): Partner
    {
        $client = new Client();

        $response = $client->put($this->endpoint . '/partners/' . $partner->id, [
            'headers' => [
                'X-API-KEY' => $this->apiKey,
                'Content-type' => 'application/json'
            ],
            'body' => json_encode($partner->toArray())
        ]);

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
                case 403:
                    throw new DoesntHaveAccessToResourceException();
                    break;
                case 404:
                    throw new NonExistentResourceException();
                    break;
                case 422:
                    throw new ValidationErrorException();
                    break;
                case 429:
                    throw new TooManyRequestException();
                    break;
                case 500:
                    throw new InternalServerErrorException();
                    break;
                default:
                    throw new BillingoException("Unknown error");
                    break;
            }
        }

        $result = new Partner();
        $result->loadFromResponse(json_decode($response->getBody()->getContents()));

        return $result;
    }

    public function deletePartner(Partner $partner): bool
    {
        $client = new Client();

        $response = $client->delete($this->endpoint . '/partners/' . $partner->id, [
            'headers' => [
                'X-API-KEY' => $this->apiKey
            ]
        ]);

        $statusCode = $response->getStatusCode();
        if ($statusCode !== 204) {
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
                case 403:
                    throw new DoesntHaveAccessToResourceException();
                    break;
                case 404:
                    throw new NonExistentResourceException();
                    break;
                case 429:
                    throw new TooManyRequestException();
                    break;
                case 500:
                    throw new InternalServerErrorException();
                    break;
                default:
                    throw new BillingoException("Unknown error");
                    break;
            }
        }

        return true;
    }
}