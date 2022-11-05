<?php

namespace RichardEszes\Billingo\Exceptions;

class DoesntHaveSubscriptionException extends BillingoException
{
    protected $message = "Authenticated user doesn't have subscription.";
    
    protected $code = 402;
}