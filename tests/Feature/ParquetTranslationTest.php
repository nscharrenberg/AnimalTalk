<?php

namespace Tests\Feature;

use Tests\TestCase;

class ParquetTranslationTest extends TestCase
{
    public function test_parquet_to_parrot(): void
    {
        $expected = "Ik praat je na tjilp piep piep tjilp tjilp piep";
        $to = "papegaai";

        $this->perform_test($to, $expected);
    }

    public function test_parquet_language_detected(): void
    {
        $message = "tjilp tjilp piep tjilp piep piep";
        $expected = "Ik praat je na tjilp tjilp piep tjilp piep piep";
        $from = "auto";
        $to = "papegaai";

        $response = $this->post('/api/translate', [
            "text" => $message,
            "from" => $from,
            "to" => $to
        ]);

        $response
            ->assertStatus(200)
            ->assertSimilarJson([
                "text" => $expected,
                "from" => "parkiet",
                "to" => $to,
                "detected" => true
            ]);

    }

    public function test_parquet_to_human(): void
    {
        $message = "tjilp tjilp piep tjilp piep piep";
        $from = "parkiet";
        $to = "human";

        $response = $this->post('/api/translate', [
            "text" => $message,
            "from" => $from,
            "to" => $to
        ]);

        $response
            ->assertStatus(500)
            ->assertSimilarJson([
                "error" => "De geselecteerde taal kan niet worden vertaald."
            ]);
    }

    public function test_parquet_to_labrador(): void
    {
        $message = "tjilp tjilp piep tjilp piep piep";
        $from = "parkiet";
        $to = "labrador";

        $response = $this->post('/api/translate', [
            "text" => $message,
            "from" => $from,
            "to" => $to
        ]);

        $response
            ->assertStatus(500)
            ->assertSimilarJson([
                "error" => "De geselecteerde taal kan niet worden vertaald."
            ]);
    }

    public function test_parquet_to_poedel(): void
    {
        $message = "tjilp tjilp piep tjilp piep piep";
        $from = "parkiet";
        $to = "poedel";

        $response = $this->post('/api/translate', [
            "text" => $message,
            "from" => $from,
            "to" => $to
        ]);

        $response
            ->assertStatus(500)
            ->assertSimilarJson([
                "error" => "De geselecteerde taal kan niet worden vertaald."
            ]);
    }

    public function test_parquet_invalid_input(): void
    {
        $message = "tjilp tjilp waf tjilp piep piep";
        $from = "parkiet";
        $to = "papegaai";

        $response = $this->post('/api/translate', [
            "text" => $message,
            "from" => $from,
            "to" => $to
        ]);

        $response
            ->assertStatus(500)
            ->assertSimilarJson([
                "error" => "Input komt niet overeen met geselecteerde taal."
            ]);
    }

    private function perform_test($to, $expected) {
        $message = "tjilp piep piep tjilp tjilp piep";
        $from = "parkiet";

        $response = $this->post('/api/translate', [
            "text" => $message,
            "from" => $from,
            "to" => $to
        ]);

        $response
            ->assertStatus(200)
            ->assertSimilarJson([
                "text" => $expected,
                "from" => $from,
                "to" => $to,
                "detected" => false
            ]);
    }
}
