<?php

namespace RichardEszes\Billingo\Controllers;

use GuzzleHttp\Client;
use RichardEszes\Billingo\Exceptions\BillingoException;
use RichardEszes\Billingo\Exceptions\DoesntHaveAccessToResourceException;
use RichardEszes\Billingo\Exceptions\DoesntHaveSubscriptionException;
use RichardEszes\Billingo\Exceptions\InternalServerErrorException;
use RichardEszes\Billingo\Exceptions\MalformedException;
use RichardEszes\Billingo\Exceptions\NonExistentResourceException;
use RichardEszes\Billingo\Exceptions\TooManyRequestsException;
use RichardEszes\Billingo\Exceptions\UnauthorizedException;
use RichardEszes\Billingo\Exceptions\UndefinedEntityException;
use RichardEszes\Billingo\Exceptions\ValidationErrorException;
use RichardEszes\Billingo\Models\Partner;

class PartnerController extends AbstractController
{
    public function __construct(protected Client $client, protected null|Partner $partner){}

    /**
     * Search and list partners based on the given parameters.
     * 
     * @param array $params
     * @return array
     * @throws MalformedException
     * @throws UnauthorizedException
     * @throws DoesntHaveSubscriptionException
     * @throws ValidationErrorException
     * @throws TooManyRequestsException
     * @throws InternalServerErrorException
     * @throws BillingoException
     */
    public function list($params = []): array
    {
        $response = $this->client->get(
            '/v3/partners',
            [
                'form_params' => $params
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

        $result = [];
        $partners = json_decode($response->getBody()->getContents())->data;
        foreach ($partners as $row) {
            $partner = new Partner();
            $partner->hydrate($row);
            $result[] = $partner;
        }

        return $result;
    }

    /**
     * Create partner.
     * 
     * @return Partner
     * @throws UndefinedEntityException
     * @throws MalformedException
     * @throws UnauthorizedException
     * @throws DoesntHaveSubscriptionException
     * @throws DoesntHaveAccessToResourceException
     * @throws ValidationErrorException
     * @throws TooManyRequestsException
     * @throws InternalServerErrorException
     * @throws BillingoException
     */
    public function create(): Partner
    {
        if ($this->partner === null) {
            throw new UndefinedEntityException();
        }

        $response = $this->client->post(
            '/v3/partners', 
            [
                'body' => json_encode($this->partner->toRequest())
            ]
        );

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

        $result = new Partner($response);

        return $result;
    }

    /**
     * Get a partner.
     * 
     * @param int $partnerId
     * @return Partner
     * @throws UndefinedEntityException
     * @throws MalformedException
     * @throws UnauthorizedException
     * @throws DoesntHaveSubscriptionException
     * @throws NonExistentResourceException
     * @throws ValidationErrorException
     * @throws TooManyRequestsException
     * @throws InternalServerErrorException
     * @throws BillingoException
     */
    public function get(): Partner
    {
        if ($this->partner === null) {
            throw new UndefinedEntityException();
        }

        return $this->getById($this->partner->id);
    }

    /**
     * Get a partner.
     * 
     * @param int $partnerId
     * @return Partner
     * @throws MalformedException
     * @throws UnauthorizedException
     * @throws DoesntHaveSubscriptionException
     * @throws NonExistentResourceException
     * @throws ValidationErrorException
     * @throws TooManyRequestsException
     * @throws InternalServerErrorException
     * @throws BillingoException
     */
    public function getById(int $partnerId): Partner
    {
        $response = $this->client->get('/v3/partners/' . $partnerId);

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

        $result = new Partner($response);

        return $result;
    }

    /**
     * Update a partner.
     * 
     * @return Partner
     * @throws UndefinedEntityException
     * @throws MalformedException
     * @throws UnauthorizedException
     * @throws DoesntHaveSubscriptionException
     * @throws DoesntHaveAccessToResourceException
     * @throws NonExistentResourceException
     * @throws ValidationErrorException
     * @throws TooManyRequestsException
     * @throws InternalServerErrorException
     * @throws BillingoException
     */
    public function update(): Partner
    {
        if ($this->partner === null) {
            throw new UndefinedEntityException();
        }

        $response = $this->client->put(
            '/v3/partners/' . $this->partner->id, 
            [
                'body' => json_encode($this->partner->toRequest())
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

        $result = new Partner($response);

        return $result;
    }

    /**
     * Delete a partner.
     * 
     * @return bool
     * @throws UndefinedEntityException
     * @throws MalformedException
     * @throws UnauthorizedException
     * @throws DoesntHaveSubscriptionException
     * @throws DoesntHaveAccessToResourceException
     * @throws NonExistentResourceException
     * @throws TooManyRequestsException
     * @throws InternalServerErrorException
     * @throws BillingoException
     */
    public function delete(): bool
    {
        if ($this->partner === null) {
            throw new UndefinedEntityException();
        }

        $response = $this->client->delete('/v3/partners/' . $this->partner->id);

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

        return true;
    }
}