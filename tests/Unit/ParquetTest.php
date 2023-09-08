<?php

namespace Tests\Unit;

use App\Models\Parquet;
use App\Models\Parrot;
use PHPUnit\Framework\TestCase;

class ParquetTest extends TestCase
{
    public function test_translate_success(): void
    {
        $message = "This is a test message";
        $expected = "piep tjilp tjilp piep piep";
        $translation = Parquet::translate($message);
        $this->assertEquals($expected, $translation);
    }

    public function test_sentence_validity_pass(): void
    {
        $message = "piep tjilp tjilp piep piep";
        $isValid = Parquet::valid($message);

        $this->assertTrue($isValid);
    }

    public function test_sentence_validity_fail(): void
    {
        $message = "piep tjilp tjilp woef piep piep";
        $isValid = Parquet::valid($message);

        $this->assertFalse($isValid);
    }

    public function test_detect_language_pass(): void
    {
        $message = "piep tjilp tjilp tjilp piep";
        $isValid = Parquet::detected($message);

        $this->assertTrue($isValid);
    }

    public function test_detect_language_fail(): void
    {
        $message = "piep woef tjilp tjilp piep piep";
        $isValid = Parquet::detected($message);

        $this->assertFalse($isValid);
    }

    public function test_translateable_items(): void
    {
        $expected = [
            Parrot::class
        ];

        $actual = Parquet::translateable();

        $this->assertEqualsCanonicalizing($expected, $actual);
    }
}
