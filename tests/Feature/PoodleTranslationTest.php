<?php

namespace Tests\Feature;

use Tests\TestCase;

class PoodleTranslationTest extends TestCase
{
    public function test_poodle_to_labrador(): void
    {
        $expected = "woef woef woef woef woef";
        $to = "labrador";

        $this->perform_test($to, $expected);
    }

    public function test_poodle_to_parrot(): void
    {
        $expected = "Ik praat je na woefie woefie woefie woefie woefie";
        $to = "papegaai";

        $this->perform_test($to, $expected);
    }

    public function test_poodle_language_detected(): void
    {
        $message = "woefie woefie woefie woefie";
        $expected = "woef woef woef woef";
        $from = "auto";
        $to = "labrador";

        $response = $this->post('/api/translate', [
            "text" => $message,
            "from" => $from,
            "to" => $to
        ]);

        $response
            ->assertStatus(200)
            ->assertSimilarJson([
                "text" => $expected,
                "from" => "poedel",
                "to" => $to,
                "detected" => true
            ]);

    }

    public function test_poodle_to_human(): void
    {
        $message = "woefie woefie woefie woefie";
        $from = "poedel";
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

    public function test_poodle_to_parquet(): void
    {
        $message = "woefie woefie woefie woefie";
        $from = "poedel";
        $to = "parkiet";

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

    public function test_labrador_invalid_input(): void
    {
        $message = "woefie woef woefie woefie";
        $from = "poedel";
        $to = "labrador";

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
        $message = "woefie woefie woefie woefie woefie";
        $from = "poedel";

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
