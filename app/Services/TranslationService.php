<?php

namespace App\Services;

use App\Exceptions\InvalidInputException;
use App\Exceptions\LanguageNotDetectedException;
use App\Exceptions\NotTranslateableException;
use App\Helpers\Drunk;
use App\Models\Human;
use App\Models\ILanguage;
use App\Models\Labrador;
use App\Models\Parquet;
use App\Models\Parrot;
use App\Models\Poodle;

class TranslationService
{
    private array $languages = [
        "mens" => Human::class,
        "labrador" => Labrador::class,
        "poedel" => Poodle::class,
        "parkiet" => Parquet::class,
        "papegaai" => Parrot::class
    ];

    private array $originLanguages = [
        "mens" => Human::class,
        "labrador" => Labrador::class,
        "poedel" => Poodle::class,
        "parkiet" => Parquet::class,
    ];

    /**
     * Get a list of all languages.
     *
     * @return array|string[] - The list of languages
     */
    private function getLanguages(): array {
        return $this->languages;
    }

    /**
     * Get a list of languages that can be translated.
     *
     * @return array|string[] - The list of languages
     */
    public function getOriginLanguages(): array {
        return array_keys($this->originLanguages);
    }

    /**
     * Get a list of languages that can be translated to from a given language.
     *
     * @param string $language The source language for which translation options are requested.
     * @return array An array of language names that can be translated to from the specified source language.
     */
    public function getTranslateableLanguages(string $language): array {
        $found = $this->findLanguage($language, $this->languages);

        $collect = [];

        if (!$found) {
            return $collect;
        }

        foreach ($found::translateable() as $key => $item) {
            $collect[] = $this->findLanguageString(new $item(), $this->languages);
        }

        return $collect;
    }

    /**
     * Translate a sentence from one language to another.
     *
     * @param string $sentence - The sentence to be translated.
     * @param string $to - The target language to which the sentence should be translated.
     * @param string $from - The source language from which the sentence is being translated
     * @param bool $drunk - Whether to apply a drunk translation
     *
     * @return array An object containing the translation result with the following keys:
     *   - "text" (string): The translated sentence.
     *   - "to" (string): The identifier of the target language.
     *   - "from" (string): The identifier of the source language.
     *   - "detected" (bool): Whether language detection was performed.
     *
     * @throws \Exception Raised if the origin or target language cannot be found.
     * @throws InvalidInputException Raised if the input sentence is not valid in the origin language.
     * @throws NotTranslateableException Raised if translation between the origin and target languages is not possible.
     */
    public function translate(string $sentence, string $to, string $from = "auto", $drunk = false): array {
        $detect = false;

        if ($from === "auto") {
            $detect = true;

            $fromLanguage = $this->detectLanguage($sentence);
        } else {
            $fromLanguage = $this->findLanguage($from, $this->originLanguages);
        }

        if (is_null($fromLanguage)) {
            throw new \Exception("De geselecteerde originele taal kan niet worden gevonden.");
        }

        $toLanguage = $this->findLanguage($to, $this->languages);

        if (is_null($toLanguage)) {
            throw new \Exception("De geselecteerde taal kan niet worden gevonden.");
        }

        $valid = $fromLanguage::valid($sentence);

        if (!$valid) {
            throw new InvalidInputException();
        }

        $translateable = $this->isTranslateable($fromLanguage, $toLanguage);

        if (!$translateable) {
            throw new NotTranslateableException();
        }

        $translation = $toLanguage::translate($fromLanguage, $sentence);

        if ($drunk) {
            $translation = Drunk::translate($translation);
        }

        return [
            "text" => $translation,
            "to" =>  $this->findLanguageString($toLanguage, $this->languages),
            "from" => $this->findLanguageString($fromLanguage, $this->originLanguages),
            "detected" => $detect,
        ];
    }

    /**
     * Check if translation is possible between two languages.
     *
     * @param ILanguage $from The origin language for translation.
     * @param ILanguage $to The language to translate to.
     *
     * @return bool True if translation is possible, false otherwise.
     */
    private function isTranslateable(ILanguage $from, ILanguage $to) {
        $expected = $from::translateable();

        return !is_null($this->findLanguageString($to, $expected));
    }

    /**
     * Attempt to find the language only based on the given sentence.
     *
     * @param string $sentence - The given sentence
     * @return ILanguage|null - The language that was found.
     * @throws LanguageNotDetectedException - Raised when it could not detect a language.
     */
    private function detectLanguage(string $sentence): ?ILanguage {
        foreach ($this->languages as $key => $language) {
            if ($language::detect($sentence)) {
                return new $language();
            }
        }

        throw new LanguageNotDetectedException();
    }

    /**
     * Find a language based on its identifier.
     *
     * @param string $input The identifier of the language to find.
     * @param array $languages The list of language to search from
     *
     * @return ILanguage|null The language if found, or null if not found.
     */
    private function findLanguage(string $input, array $languages): ?ILanguage {
        foreach ($languages as $key => $language) {
            if ($input === $key) {
                return new $language();
            }
        }

        return null;
    }

    /**
     * Find the identifier of a language object within an array of languages.
     *
     * @param ILanguage $input The language for which to find the identifier.
     * @param array $languages The list of language to search from
     *
     * @return string|null The language identifier if found, or null if not found.
     */
    private function findLanguageString(ILanguage $input, array $languages): ?string {
        foreach ($languages as $key => $language) {
            if ($input instanceof $language) {
                return $key;
            }
        }

        return null;
    }
}
