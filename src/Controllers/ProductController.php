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
use RichardEszes\Billingo\Models\Product;

class ProductController extends AbstractController
{
    public function __construct(protected Client $client, protected null|Product $product){}

    /**
     * Search and list products based on the given parameters.
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
            '/v3/products', 
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
        $products = json_decode($response->getBody()->getContents())->data;
        foreach ($products as $row) {
            $product = new Product();
            $product->hydrate($row);
            $result[] = $product;
        }

        return $result;
    }

    /**
     * Create product.
     * 
     * @return Product
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
    public function create(): Product
    {
        if ($this->product === null) {
            throw new UndefinedEntityException();
        }

        $response = $this->client->post(
            '/v3/products', 
            [
                'body' => json_encode($this->product->toRequest())
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

        $result = new Product($response);

        return $result;
    }

    /**
     * Get a product.
     * 
     * @return Product
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
    public function get(): Product
    {
        if ($this->product === null) {
            throw new UndefinedEntityException();
        }

        return $this->getById($this->product->id);
    }

    /**
     * Get a product.
     * 
     * @param int $productId
     * @return Product
     * @throws MalformedException
     * @throws UnauthorizedException
     * @throws DoesntHaveSubscriptionException
     * @throws NonExistentResourceException
     * @throws ValidationErrorException
     * @throws TooManyRequestsException
     * @throws InternalServerErrorException
     * @throws BillingoException
     */
    public function getById(int $productId): Product
    {
        $response = $this->client->get('/products/' . $productId);

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

        $result = new Product($response);

        return $result;
    }

    /**
     * Update a product.
     * 
     * @return Product
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
    public function update(): Product
    {
        if ($this->product === null) {
            throw new UndefinedEntityException();
        }

        $response = $this->client->put(
            '/v3/products/' . $this->product->id,
            [
                'body' => json_encode($this->product->toRequest())
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

        $result = new Product($response);

        return $result;
    }

    /**
     * Delete a product.
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
        if ($this->product === null) {
            throw new UndefinedEntityException();
        }

        $response = $this->client->delete('/v3/products/' . $this->product->id);

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