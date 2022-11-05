<?php

namespace RichardEszes\Billingo\Exceptions;

class NonExistentResourceException extends BillingoException
{
    protected $message = "Non-existent resource is requested.";
    
    protected $code = 404;
}