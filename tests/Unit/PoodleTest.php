<?php

namespace Tests\Unit;

use App\Models\Labrador;
use App\Models\Parrot;
use App\Models\Poodle;
use PHPUnit\Framework\TestCase;

class PoodleTest extends TestCase
{
    public function test_translate_success(): void
    {
        $message = "This is a test message";
        $expected = "woefie woefie woefie woefie woefie";
        $translation = Poodle::translate($message);
        $this->assertEquals($expected, $translation);
    }

    public function test_sentence_validity_pass(): void
    {
        $message = "woefie woefie woefie woefie";
        $isValid = Poodle::valid($message);

        $this->assertTrue($isValid);
    }

    public function test_sentence_validity_fail(): void
    {
        $message = "woefie woef woefie woefie";
        $isValid = Poodle::valid($message);

        $this->assertFalse($isValid);
    }

    public function test_detect_language_pass(): void
    {
        $message = "woefie woefie woefie woefie";
        $isValid = Poodle::detected($message);

        $this->assertTrue($isValid);
    }

    public function test_detect_language_fail(): void
    {
        $message = "woefie woefie waf woefie woefie";
        $isValid = Poodle::detected($message);

        $this->assertFalse($isValid);
    }

    public function test_translateable_items(): void
    {
        $expected = [
            Parrot::class,
            Labrador::class
        ];

        $actual = Poodle::translateable();

        $this->assertEqualsCanonicalizing($expected, $actual);
    }
}
