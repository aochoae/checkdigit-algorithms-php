<?php
/**
 * @copyright Copyright (c) 2021 Luis A. Ochoa
 * @since     1.0.0
 * @license   https://opensource.org/licenses/MIT MIT License
 */

namespace LuisAlberto\CheckDigit\Test;

use LuisAlberto\CheckDigit\DammCheckDigit;

use PHPUnit\Framework\TestCase;

/**
 * Class DammCheckDigitTest
 *
 * @package LuisAlberto\CheckDigit\Test
 * @since 1.0.0
 */
class DammCheckDigitTest extends TestCase
{
    public function testGenerate()
    {
        $damm = new DammCheckDigit();

        $this->assertEquals($damm->generate("28041986"), "280419866");
    }

    public function testIsValidTrue()
    {
        $damm = new DammCheckDigit();

        $this->assertTrue($damm->isValid("080419879"));
    }

    public function testIsValidFalse()
    {
        $damm = new DammCheckDigit();

        $this->assertFalse($damm->isValid("15195079090"));
    }

    public function testInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $damm = new DammCheckDigit();
        $damm->generate("0123456789ABCDEF");
    }
}