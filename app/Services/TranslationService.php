<?php

namespace App\Services;

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
