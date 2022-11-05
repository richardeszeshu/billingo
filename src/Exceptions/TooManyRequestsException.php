<?php

namespace RichardEszes\Billingo\Exceptions;

class TooManyRequestsException extends BillingoException
{
    protected $message = "Too many requests.";
    
    protected $code = 429;
}