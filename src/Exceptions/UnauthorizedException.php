<?php

namespace RichardEszes\Billingo\Exceptions;

class UnauthorizedException extends BillingoException
{
    protected $message = "Authorization information is missing or invalid.";
    
    protected $code = 401;
}