<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Drunk
{
    /**
     * Translates a sentence to showcase drunk-like effects.
     *
     * @param string $sentence - The original sentence to be translated.
     * @param int $n - The interval at which words will be reversed
     * @param string $cheersWord - The word to be inserted in the middle of the sentence
     * @param string $burpWord - The word to be appended to the end of the sentence.
     * @return string - The "drunkified" translation of the text.
     */
    public static function translate(string $sentence, int $n = 4, string $cheersWord = "Proost!", string $burpWord = " Burp!"): string {
        $sentence = Translator::reverseEveryXthWord($sentence, $n);
        $sentence = Translator::addWordInXthPositionOfSentence($sentence, (Str::length($sentence) / 2), $cheersWord);
        return Translator::addWordInXthPositionOfSentence($sentence, Str::length($sentence), $burpWord);
    }
}
