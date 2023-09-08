<?php

namespace App\Models;

use App\Helpers\Translator;

class Parquet implements ILanguage
{
    private static array $sounds = [
        "tjilp",
        "piep"
    ];

    /**
     * Translate the original text to the language of a Parquet.
     *
     * Rules: Replace any word starting with a vowel with "tjilp" and all other words with "piep"
     *
     * @param ILanguage $origin - The original Language to be translated.
     * @param string $text - The text to be translated.
     * @return string - The translated text.
     */
    public static function translate(ILanguage $origin, string $text): string
    {
        $words = explode(" ", $text);
        $vowels = "/\b[aeiouAEIOU]\w*\b/";

        foreach ($words as $key => $word) {
            if (preg_match($vowels, $word)) {
                $words[$key] = Parquet::$sounds[0];
            } else {
                $words[$key] = Parquet::$sounds[1];
            }
        }

        return implode(" ", $words);
    }

    /**
     * Check if the given text is valid Parrot language.
     *
     * @param string $text - The text to be validated.
     * @return bool - True if the text is valid in Parquet Language, False otherwise.
     */
    public static function valid(string $text): bool
    {
        return Translator::sentenceContainsOnlyWords($text, Parquet::$sounds);
    }

    /**
     * Detect if the given text is Parquet Language.
     *
     * @param string $text - The text to be analysed.
     * @return bool - True if Parquet language is detected, False otherwise.
     */
    public static function detected(string $text): bool
    {
        return Parquet::valid($text);
    }

    /**
     * Get a list of classes that can translate the Parquet language.
     *
     * @return string[] - A list of languages that can translate the Parquet language.
     */
    public static function translateable(): array
    {
        return [
            Parrot::class
        ];
    }
}
