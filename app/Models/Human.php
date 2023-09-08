<?php

namespace App\Models;

use App\Exceptions\NotTranslateableException;

class Human implements ILanguage
{
    /**
     * Can not translate from any language to Human Language.
     *
     * @throws NotTranslateableException - Occurs when attempting to translate to Human language.
     */
    public static function translate(ILanguage $origin, string $text): string
    {
        throw new NotTranslateableException();
    }

    /**
     * Checks if the text is valid.
     *
     * @param string $text - The text to be analysed.
     * @return bool - Always True, as we do not have fixed rules for Human languages.
     */
    public static function valid(string $text): bool
    {
        return true;
    }

    /**
     * Checks if the text is of Human language.
     *
     * @param string $text - The text to be analysed.
     * @return bool - Always False, as we can not determine if it is Human language based on the rules.
     */
    public static function detected(string $text): bool
    {
        return false;
    }

    /**
     * @return string[] - List of languages that can translate Human language.
     */
    public static function translateable(): array
    {
        return [
            Labrador::class,
            Poodle::class,
            Parquet::class,
            Parquet::class
        ];
    }
}
