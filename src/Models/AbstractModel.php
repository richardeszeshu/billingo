<?php

declare(strict_types=1);

namespace RichardEszes\Billingo\Models;

use GuzzleHttp\Psr7\Response;

abstract class AbstractModel
{

    /**
     * @param null|Response $response
     */
    public function __construct(null|Response $response = null)
    {
        if ($response !== null) {
            $this->loadFromResponse($response);
        }
    }

    /**
     * General getter.
     * 
     * @param string $name
     * @return mixed
     */
    public function __get($name): mixed
    {
        return $this->$name;
    }

    /**
     * Converts this object to array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->objectToArray($this);
    }

    /**
     * Convert this object to array which can be accepted by Billingo.
     * 
     * @return array
     */
    public function toRequest(): array
    {
        $fields = $this->objectToArray($this);
        foreach ($fields as $name => $value) {
            if ($value === null) {
                unset($fields[$name]);
            }
        }

        return $fields;
    }

    /**
     * Hydrate this object.
     * 
     * @param array $data
     * @return self
     */
    public function hydrate(array $data): self
    {
        foreach ($data as $attribute => $value) {
            if (is_object($value)) {
                $value = $this->objectToArray($value);
            }
            $method = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $attribute)));
            if (is_callable(array($this, $method))) {
                $this->$method($value);
            }
        }

        return $this;
    }

    /**
     * Recursive function to convert object to array.
     * 
     * @param object $object
     * @return array
     */
    protected function objectToArray(object $object)
    {
        $array = get_object_vars($object);
        foreach ($object as $key => $row) {
            if (is_object($row)) {
                $array[$key] = $this->objectToArray($row);
            }
        }

        return $array;
    }

    /**
     * Hydrate this object from Response.
     * 
     * @param Response $response
     * @return self
     */
    public function loadFromResponse(Response $response): self
    {
        $body = json_decode($response->getBody()->getContents());
        $this->hydrate(get_object_vars($body));

        return $this;
    }

}