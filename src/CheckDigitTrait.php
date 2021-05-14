<?php
/**
 * @copyright Copyright (c) Luis A. Ochoa
 * @since     1.0.0
 * @license   https://opensource.org/licenses/MIT MIT License
 */

namespace LuisAlberto\CheckDigit;

/**
 * Trait CheckDigitTrait
 *
 * @package LuisAlberto\CheckDigit
 * @since 1.0.0
 */
trait CheckDigitTrait
{
    /**
     * Retrieves an array containing the digit sequence.
     *
     * @param string $sequence
     * @return array
     */
    protected function toDigits(string $sequence) {

        if (preg_match("/^\d+$/", $sequence) !== 1) {
            throw new \InvalidArgumentException();
        }

        return str_split($sequence);
    }
}