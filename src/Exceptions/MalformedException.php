<?php

namespace RichardEszes\Billingo\Exceptions;

class MalformedException extends BillingoException
{
    protected $message = "The request is malformed.";

    protected $code = 400;
}