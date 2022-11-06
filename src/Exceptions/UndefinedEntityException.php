<?php

namespace RichardEszes\Billingo\Exceptions;

use Exception;

class UndefinedEntityException extends Exception
{
    protected $message = "Please specify an entity before this call.";
    
    protected $code = 400;
}