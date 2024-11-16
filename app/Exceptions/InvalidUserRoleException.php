<?php

namespace App\Exceptions;

use Exception;

class InvalidUserRoleException extends Exception
{
    protected $message = 'The provided user role is invalid.';
    protected $code = 400; // HTTP 400 Bad Request
}
