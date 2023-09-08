<?php

namespace Tests\Unit;

use App\Exceptions\NotTranslateableException;
use App\Models\Human;
use App\Models\Labrador;
use App\Models\Parquet;
use App\Models\Parrot;
use App\Models\Poodle;
use PHPUnit\Framework\TestCase;

class HumanTest extends TestCase
{
    public function test_translation_gives_exception(): void
    {
        $this->expectException(NotTranslateableException::class);
        $this->expectExceptionMessage("De geselecteerde taal kan niet worden vertaald.");

        Human::translate("This is a test message");
    }

    public function test_translateable_items(): void
    {
        $expected = [
            Labrador::class,
            Poodle::class,
            Parrot::class,
            Parquet::class
        ];

        $actual = Human::translateable();

        $this->assertEqualsCanonicalizing($expected, $actual);
    }
}
