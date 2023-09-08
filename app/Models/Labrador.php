<?php

namespace App\Models;

use App\Helpers\Translator;

class Labrador implements ILanguage
{
    private static string $sound = "woef";

    public static function translate(ILanguage $origin, string $text): string
    {
        return Translator::replaceAllWordWithX($text, Labrador::$sound);
    }

    public static function valid(string $text): bool
    {
        return Translator::sentenceContainsOnlyWords($text, [Labrador::$sound]);
    }

    public static function detected(string $text): bool
    {
        return Labrador::valid($text);
    }

    public static function translateable(): array
    {
        return [
            Poodle::class,
            Parrot::class
        ];
    }
}
