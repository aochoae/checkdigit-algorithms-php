<?php
/**
 * @copyright Copyright (c) Luis A. Ochoa
 * @since     1.0.0
 * @license   https://opensource.org/licenses/MIT MIT License
 */

namespace LuisAlberto\CheckDigit\Test;

use LuisAlberto\CheckDigit\VerhoeffCheckDigit;

use PHPUnit\Framework\TestCase;

/**
 * Class VerhoeffCheckDigitTest
 *
 * @package LuisAlberto\CheckDigit\Test
 * @since 1.0.0
 */
class VerhoeffCheckDigitTest extends TestCase
{
    public function testGenerate()
    {
        $verhoeff = new VerhoeffCheckDigit();

        $this->assertEquals($verhoeff->generate("026253305"), "0262533057");
    }

    public function testIsValidTrue()
    {
        $verhoeff = new VerhoeffCheckDigit();

        $this->assertTrue($verhoeff->isValid("0262533057"));
    }

    public function testIsValidFalse()
    {
        $verhoeff = new VerhoeffCheckDigit();

        $this->assertFalse($verhoeff->isValid("0262533056"));
    }

    public function testInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $verhoeff = new VerhoeffCheckDigit();
        $verhoeff->generate("123e-10");
    }
}