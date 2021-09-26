<?php
/**
 * @copyright Copyright (c) Luis A. Ochoa
 * @since     1.0.0
 * @license   https://opensource.org/licenses/MIT MIT License
 */

namespace LuisAlberto\CheckDigit;

/**
 * Class LuhnCheckDigit
 *
 * @package LuisAlberto\CheckDigit
 * @since 1.0.0
 */
final class LuhnCheckDigit implements CheckDigitInterface
{
    use CheckDigitTrait;

    /**
     * Gives the substitute for each digit.
     *
     * <pre>
     * 4 * 2 = 8
     * 8 * 2 = 16 => 1 + 6 = 7
     * </pre>
     *
     * <pre>
     * 0, 1, 2, 3, 4, 5, 6, 7, 8, 9
     * 0, 2, 4, 6, 8, 1, 3, 5, 7, 9
     * </pre>
     */
    const SUBSTITUTE = [0, 2, 4, 6, 8, 1, 3, 5, 7, 9];

    public function generate(string $sequence)
    {
        return $this->compute($this->toDigits($sequence));
    }

    public function isValid(string $sequence)
    {
        $subSequence = substr($sequence, 0, -1);

        return strcmp($sequence, $this->compute($this->toDigits($subSequence))) === 0;
    }

    /**
     * Retrieves a string containing the digit sequence with the check digit.
     *
     * @param array $sequence
     * @return string
     */
    private function compute(array $sequence)
    {
        $newSequence = [];

        for ($i = 0; $i < count($sequence); $i++) {
            $newSequence[$i] = ($i % 2 === 0) ? self::SUBSTITUTE[$sequence[$i]] : $sequence[$i];
        }

        $summation = array_sum($newSequence);

        $lastDigit = ($summation * 9) % 10;

        return join(array_merge($sequence, [$lastDigit]));
    }
}
