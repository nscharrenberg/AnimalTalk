<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DrunkTranslationTest extends TestCase
{
    public function test_drunk_translations(): void
    {
        $message = "Dit is een test bericht";
        $expected = "woef woef woProost!ef feow woef Burp!";
        $from = "mens";
        $to = "labrador";

        $response = $this->post('/api/translate', [
            "text" => $message,
            "from" => $from,
            "to" => $to,
            "drunk" => true
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
