<?php
/**
 * @copyright Copyright (c) Luis A. Ochoa
 * @since     1.0.0
 * @license   https://opensource.org/licenses/MIT MIT License
 */

namespace LuisAlberto\CheckDigit\Test;

use LuisAlberto\CheckDigit\LuhnCheckDigit;

use PHPUnit\Framework\TestCase;

/**
 * Class LuhnCheckDigitTest
 *
 * @package LuisAlberto\CheckDigit\Test
 * @since 1.0.0
 */
class LuhnCheckDigitTest extends TestCase
{
    public function testGenerate()
    {
        $luhn = new LuhnCheckDigit();
        
        $this->assertEquals($luhn->generate("4872148"), "48721484");
    }

    public function testIsValidTrue()
    {
        $luhn = new LuhnCheckDigit();

        $this->assertTrue($luhn->isValid("48721484"));
    }

    public function testIsValidFalse()
    {
        $luhn = new LuhnCheckDigit();

        $this->assertFalse($luhn->isValid("48721488"));
    }

    public function testInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $luhn = new LuhnCheckDigit();
        $luhn->generate("123 456 789");
    }
}
