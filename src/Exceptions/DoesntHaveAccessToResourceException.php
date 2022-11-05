<?php

namespace RichardEszes\Billingo\Exceptions;

class DoesntHaveAccessToResourceException extends BillingoException
{
    protected $message = "Authenticated user doesn't have access to the resource.";
    
    protected $code = 403;
}