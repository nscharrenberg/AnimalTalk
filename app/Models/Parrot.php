<?php

namespace App\Models;

class Parrot implements ILanguage
{

    /**
     * Translate the original text to the language of a Parrot.
     *
     * Rules: Start the sentence with "ik praat je na " followed by the given text.
     *
     * @param string $text - The text to be translated.
     * @return string - The translated text.
     */
    public static function translate(string $text): string
    {
        return "Ik praat je na {$text}";
    }

    /**
     * Check if the given text is valid Parrot language.
     *
     * @param string $text - The text to be validated.
     * @return bool - Always false, as we can not translate Parrot Language to any other language.
     */
    public static function valid(string $text): bool
    {
        return false;
    }

    /**
     * Detect if the given text is Parrot Language.
     *
     * @param string $text - The text to be analysed.
     * @return bool - Always False, as we can not translate Parrot Language to any other language.
     */
    public static function detected(string $text): bool
    {
        return false;
    }

    /**
     * Get a list of classes that can translate the Parrot language.
     *
     * @return string[] - A list of languages that can translate the Parrot language.
     */
    public static function translateable(): array
    {
        return [

        ];
    }
}
