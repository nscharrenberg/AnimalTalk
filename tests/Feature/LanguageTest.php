<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LanguageTest extends TestCase
{
    public function test_origin_languages(): void
    {
        $response = $this->get('/api/translate/languages');

        $response
            ->assertStatus(200)
            ->assertSimilarJson([
                "languages" => [
                    "auto",
                    "labrador",
                    "poedel",
                    "parkiet",
                    "mens"
                ]
            ]);
    }

    public function test_from_human_languages(): void
    {
        $response = $this->get('/api/translate/languages?from=mens');

        $response
            ->assertStatus(200)
            ->assertSimilarJson([
                "languages" => [
                    "labrador",
                    "poedel",
                    "parkiet",
                    "papegaai"
                ]
            ]);
    }

    public function test_from_labrador_languages(): void
    {
        $response = $this->get('/api/translate/languages?from=labrador');

        $response
            ->assertStatus(200)
            ->assertSimilarJson([
                "languages" => [
                    "poedel",
                    "papegaai"
                ]
            ]);
    }

    public function test_from_poedel_languages(): void
    {
        $response = $this->get('/api/translate/languages?from=poedel');

        $response
            ->assertStatus(200)
            ->assertSimilarJson([
                "languages" => [
                    "labrador",
                    "papegaai"
                ]
            ]);
    }

    public function test_from_parquet_languages(): void
    {
        $response = $this->get('/api/translate/languages?from=parkiet');

        $response
            ->assertStatus(200)
            ->assertSimilarJson([
                "languages" => [
                    "papegaai"
                ]
            ]);
    }
}
