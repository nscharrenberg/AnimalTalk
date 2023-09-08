<?php

namespace App\Models;

class Poodle implements ILanguage
{

    public static function translate(ILanguage $origin, string $text): string
    {
        // TODO: Implement translate() method.
    }

    public static function valid(string $text): bool
    {
        // TODO: Implement valid() method.
    }

    public static function detected(string $text): bool
    {
        // TODO: Implement detected() method.
    }

    public static function translateable(): array
    {
        // TODO: Implement translateable() method.
    }
}
