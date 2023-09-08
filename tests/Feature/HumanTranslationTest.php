<?php

namespace Tests\Feature;

use Tests\TestCase;

class HumanTranslationTest extends TestCase
{
    public function test_human_to_labrador(): void
    {
        $expected = "woef woef woef woef woef";
        $to = "labrador";

        $this->perform_test($to, $expected);
    }

    public function test_min_text_length(): void
    {
        $message = " ";
        $from = "mens";
        $to = "labrador";

        $response = $this->post('/api/translate', [
            "text" => $message,
            "from" => $from,
            "to" => $to
        ], [
            "Accept" => "application/json"
        ]);

        $response
            ->assertStatus(422)
            ->assertSimilarJson([
                "message" => "The text field is required.",
                "errors" => [
                    "text" => [
                        "The text field is required."
                    ]
                ]
            ]);
    }

    public function test_human_to_parquet(): void
    {
        $expected = "piep tjilp tjilp piep piep";
        $to = "parkiet";

        $this->perform_test($to, $expected);
    }

    public function test_human_to_poodle(): void
    {
        $expected = "woefie woefie woefie woefie woefie";
        $to = "poedel";

        $this->perform_test($to, $expected);
    }

    public function test_human_to_parrot(): void
    {
        $expected = "Ik praat je na Dit is een test bericht";
        $to = "papegaai";

        $this->perform_test($to, $expected);
    }

    public function test_human_language_detected(): void
    {
        $message = "Dit is een test bericht";
        $from = "auto";
        $to = "labrador";

        $response = $this->post('/api/translate', [
            "text" => $message,
            "from" => $from,
            "to" => $to
        ]);

        $response
            ->assertStatus(500)
            ->assertSimilarJson([
                "error" => "Taal kon niet automatisch worden herkend."
            ]);
    }

    private function perform_test($to, $expected) {
        $message = "Dit is een test bericht";
        $from = "mens";

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
