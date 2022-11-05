<?php

namespace RichardEszes\Billingo\Exceptions;

class ValidationErrorException extends BillingoException
{
    protected $message = "Validation errors occured.";
    
    protected $code = 422;
}