<?php

namespace App\Models;

use App\Helpers\Translator;

class Labrador implements ILanguage
{
    private static string $sound = "woef";

    /**
     * Translate the original text to the language of a Labrador.
     *
     * Rules: Replace every word in the sentence by "woef".
     *
     * @param ILanguage $origin - The original Language to be translated.
     * @param string $text - The text to be translated.
     * @return string - The translated text.
     */
    public static function translate(ILanguage $origin, string $text): string
    {
        return Translator::replaceAllWordWithX($text, Labrador::$sound);
    }

    /**
     * Check if the given text is valid Labrador language.
     *
     * @param string $text - The text to be validated.
     * @return bool - True if the text is valid in Labrador Language, False otherwise.
     */
    public static function valid(string $text): bool
    {
        return Translator::sentenceContainsOnlyWords($text, [Labrador::$sound]);
    }

    /**
     * Detect if the given text is Labrador Language.
     *
     * @param string $text - The text to be analysed.
     * @return bool - True if Labrador language is detected, False otherwise.
     */
    public static function detected(string $text): bool
    {
        return Labrador::valid($text);
    }

    /**
     * Get a list of classes that can translate the Labrador language.
     *
     * @return string[] - A list of languages that can translate the Labrador language.
     */
    public static function translateable(): array
    {
        return [
            Poodle::class,
            Parrot::class
        ];
    }
}
