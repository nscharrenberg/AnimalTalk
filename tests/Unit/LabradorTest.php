<?php

namespace Tests\Unit;

use App\Models\Labrador;
use App\Models\Parquet;
use App\Models\Parrot;
use App\Models\Poodle;
use PHPUnit\Framework\TestCase;

class LabradorTest extends TestCase
{
    public function test_translate_success(): void
    {
        $message = "This is a test message";
        $expected = "woef woef woef woef woef";
        $translation = Labrador::translate($message);
        $this->assertEquals($expected, $translation);
    }

    public function test_sentence_validity_pass(): void
    {
        $message = "woef woef woef woef woef woef";
        $isValid = Labrador::valid($message);

        $this->assertTrue($isValid);
    }

    public function test_sentence_validity_fail(): void
    {
        $message = "woef woef woefie woef woef woef";
        $isValid = Labrador::valid($message);

        $this->assertFalse($isValid);
    }

    public function test_detect_language_pass(): void
    {
        $message = "woef woef woef woef woef woef";
        $isValid = Labrador::detected($message);

        $this->assertTrue($isValid);
    }

    public function test_detect_language_fail(): void
    {
        $message = "tjilp tjilp piep piep tjilp";
        $isValid = Labrador::detected($message);

        $this->assertFalse($isValid);
    }

    public function test_translateable_items(): void
    {
        $expected = [
            Poodle::class,
            Parrot::class
        ];

        $actual = Labrador::translateable();

        $this->assertEqualsCanonicalizing($expected, $actual);
    }
}
