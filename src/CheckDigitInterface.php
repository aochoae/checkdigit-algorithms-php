<?php
/**
 * @copyright Copyright (c) Luis A. Ochoa
 * @since     1.0.0
 * @license   https://opensource.org/licenses/MIT MIT License
 */

namespace LuisAlberto\CheckDigit;

/**
 * Interface CheckDigitInterface
 *
 * @package LuisAlberto\CheckDigit
 * @since 1.0.0
 */
interface CheckDigitInterface
{
    /**
     * Appends the check digit to a given digit sequence.
     *
     * @param $sequence
     * @return mixed
     */
    public function generate(string $sequence);

    /**
     * Verifies whether a digit sequence is valid.
     *
     * @param $sequence
     * @return mixed
     */
    public function isValid(string $sequence);
}
