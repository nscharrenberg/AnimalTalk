<?php

namespace Tests\Feature;

use Tests\TestCase;

class ParrotTranslationTest extends TestCase
{
    public function test_parrot_to_human(): void
    {
        $message = "tjilp tjilp piep tjilp piep piep";
        $from = "papegaai";
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

    public function test_parrot_to_labrador(): void
    {
        $message = "tjilp tjilp piep tjilp piep piep";
        $from = "papegaai";
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

    public function test_parrot_to_poodle(): void
    {
        $message = "tjilp tjilp piep tjilp piep piep";
        $from = "papegaai";
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

    public function test_parrot_to_parquet(): void
    {
        $message = "tjilp tjilp piep tjilp piep piep";
        $from = "papegaai";
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
}
