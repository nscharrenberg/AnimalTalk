<?php

namespace Tests\Unit;

use App\Models\Parrot;
use PHPUnit\Framework\TestCase;

class ParrotTest extends TestCase
{
    public function test_translation_gives_exception(): void
    {
        $message = "This is a test message";
        $expected = "Ik praat je na This is a test message";
        $translation = Parrot::translate($message);

        $this->assertEquals($expected, $translation);
    }

    public function test_translateable_items(): void
    {
        $expected = [

        ];

        $actual = Parrot::translateable();

        $this->assertEqualsCanonicalizing($expected, $actual);
    }
}
