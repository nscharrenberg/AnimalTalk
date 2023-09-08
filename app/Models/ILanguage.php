<?php

namespace App\Models;

interface ILanguage
{
    /**
     * Translate a given text from the original language to the current language.
     *
     * @param string $text - The text that needs to be translated.
     * @return string - The translated text.
     */
    public static function translate(string $text): string;

    /**
     * Inspects whether the given text is valid for the current language.
     *
     * @param string $text - the text to be analysed.
     * @return bool - True if the text is valid, False otherwise.
     */
    public static function valid(string $text): bool;

    /**
     * Inspects whether the given text is part of the current langauge.
     *
     * @param string $text - The text to be analysed.
     * @return bool - True if the text is part of this language, False otherwise.
     */
    public static function detected(string $text): bool;

    /**
     * A list of languages that can translate the current language.
     *
     * @return array - The list of languages that can translate the current language.
     */
    public static function translateable(): array;
}
