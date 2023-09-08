<?php

namespace App\Exceptions;

use Exception;

class LanguageNotDetectedException extends Exception
{
    public function __construct()
    {
        parent::__construct("Taal kon niet automatisch worden herkend.");
    }
}
