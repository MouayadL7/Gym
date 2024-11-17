<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class ActiveSubscriptionException extends Exception
{
    protected $message = "User already has an active subscription.";
    protected $code = 409;
}
