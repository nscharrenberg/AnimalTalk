<?php

namespace App\Helpers;

use Illuminate\Support\Str;

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

    /**
     * Reverse every nth word within a sentence.
     *
     * @param string $sentence - The original sentence in which words will be reversed.
     * @param int $n - The interval at which words will be reversed e.g. every 4th word.
     * @return string - The modified sentence with every nth word reversed.
     */
    public static function reverseEveryXthWord(string $sentence, int $n): string {
        $words = str_word_count($sentence, 1);

        $wordArray = [];

        foreach ($words as $key => $word) {
            if (($key + 1) % $n === 0) {
                $wordArray[] = Str::reverse($word);
                continue;
            }

            $wordArray[] = $word;
        }

        return implode(' ', $wordArray);
    }

    /**
     * Adds a word at a specified position within a sentence.
     *
     * @param string $sentence - The original sentence to which the word will be added.
     * @param int $position - The position within the sentence, where the word will be inserted.
     * @param string $word - The word to be inserted into the sentence.
     * @return string - The modified sentence with the word inserted at the specified position.
     */
    public static function addWordInXthPositionOfSentence(string $sentence, int $position, string $word): string {
        $textLength = Str::length($sentence);
        $left = Str::substr($sentence, 0, $position);
        $right = Str::substr($sentence, $position, $textLength);

        return "{$left}{$word}{$right}";
    }
}
