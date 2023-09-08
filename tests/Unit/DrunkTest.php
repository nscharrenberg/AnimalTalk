<?php

namespace Tests\Unit;

use App\Helpers\Drunk;
use PHPUnit\Framework\TestCase;

class DrunkTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_drunkified_message(): void
    {
        $message = "Dit is een test bericht voor dronken mensen";
        $expected = "Dit is een tset bericProost!ht voor dronken nesnem Burp!";

        $actual = Drunk::translate($message);
        $this->assertEquals($expected, $actual);
    }
}
