<?php

namespace App\Exceptions;

use Exception;

class InvalidInputException extends Exception
{
    public function __construct()
    {
        parent::__construct("Input komt niet overeen met geselecteerde taal");
    }
}
