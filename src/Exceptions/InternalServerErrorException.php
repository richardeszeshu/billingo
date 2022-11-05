<?php

namespace RichardEszes\Billingo\Exceptions;

class InternalServerErrorException extends BillingoException
{
    protected $message = "Internal server error.";
    
    protected $code = 500;
}