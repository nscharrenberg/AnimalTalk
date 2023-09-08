<?php

namespace App\Helpers;

class Translator
{
    /**
     * Replace all words in a sentence with a specific word.
     *
     * @param string $sentence - The original sentence to be processed.
     * @param string $word - The word to replace all words in the sentence with.
     * @return string - The modified sentence with all words replaced by a specific word.
     */
    public static function replaceAllWordWithX(string $sentence, string $word): string {
        $words = explode(" ", $sentence);
        $wordCount = count($words);
        $translated = array_fill(0, $wordCount, $word);

        return implode(" ", $translated);
    }

    /**
     * Check if a sentence consists out of only expected words.
     *
     * @param string $sentence - The original sentence to be checked.
     * @param array $expected - The only accepted words
     * @return bool - True if the sentence consists out of only expected words, False otherwise.
     */
    public static function sentenceContainsOnlyWords(string $sentence, array $expected): bool {
        $words = explode(" ", $sentence);

        foreach ($words as $word) {
            if (!in_array($word, $expected)) {
                return false;
            }
        }

        return true;
    }
}
