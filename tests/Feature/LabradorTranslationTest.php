<?php

namespace Tests\Feature;

use Tests\TestCase;

class LabradorTranslationTest extends TestCase
{
    public function test_labrador_to_poedel(): void
    {
        $expected = "woefie woefie woefie woefie woefie";
        $to = "poedel";

        $this->perform_test($to, $expected);
    }

    public function test_labrador_to_parrot(): void
    {
        $expected = "Ik praat je na woef woef woef woef woef";
        $to = "papegaai";

        $this->perform_test($to, $expected);
    }

    public function test_labrador_language_detected(): void
    {
        $message = "woef woef woef woef";
        $expected = "woefie woefie woefie woefie";
        $from = "auto";
        $to = "poedel";

        $response = $this->post('/api/translate', [
            "text" => $message,
            "from" => $from,
            "to" => $to
        ]);

        $response
            ->assertStatus(200)
            ->assertSimilarJson([
                "text" => $expected,
                "from" => "labrador",
                "to" => $to,
                "detected" => true
            ]);

    }

    public function test_labrador_to_human(): void
    {
        $message = "woef woef woef woef";
        $from = "labrador";
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

    public function test_labrador_to_parquet(): void
    {
        $message = "woef woef woef woef";
        $from = "labrador";
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
        $message = "woef woefie woef woef";
        $from = "labrador";
        $to = "poedel";

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
        $message = "woef woef woef woef woef";
        $from = "labrador";

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
