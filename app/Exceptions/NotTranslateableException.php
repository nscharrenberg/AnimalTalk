<?php

namespace App\Exceptions;

use Exception;

class NotTranslateableException extends Exception
{
    public function __construct()
    {
        parent::__construct("De geselecteerde taal kan niet worden vertaald.");
    }
}
