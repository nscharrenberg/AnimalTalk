<?php

namespace App\Models;

use App\Helpers\Translator;

class Poodle implements ILanguage
{
    private static string $sound = "woefie";

    /**
     * Translate the original text to the language of a Poodle.
     *
     * Rules: Replaces all words in the sentence with "woefie".
     *
     * @param string $text - The text to be translated.
     * @return string - The translated text.
     */
    public static function translate(string $text): string
    {
        return Translator::replaceAllWordWithX($text, Poodle::$sound);
    }

    /**
     * Check if the given text is valid Poodle language.
     *
     * @param string $text - The text to be validated.
     * @return bool - True if the text is valid in Poodle Language, False otherwise.
     */
    public static function valid(string $text): bool
    {
        return Translator::sentenceContainsOnlyWords($text, [Poodle::$sound]);
    }

    /**
     * Detect if the given text is Poodle Language.
     *
     * @param string $text - The text to be analysed.
     * @return bool - True if Poodle language is detected, False otherwise.
     */
    public static function detected(string $text): bool
    {
        return Poodle::valid($text);
    }

    /**
     * Get a list of classes that can translate the Poodle language.
     *
     * @return string[] - A list of languages that can translate the Poodle language.
     */
    public static function translateable(): array
    {
        return [
          Labrador::class,
          Parrot::class
        ];
    }
}
