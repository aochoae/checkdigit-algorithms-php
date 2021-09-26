<?php
/**
 * @copyright Copyright (c) Luis A. Ochoa
 * @since     1.0.0
 * @license   https://opensource.org/licenses/MIT MIT License
 */

namespace LuisAlberto\CheckDigit;

/**
 * Class DammCheckDigit
 *
 * @package LuisAlberto\CheckDigit
 * @since 1.0.0
 */
final class DammCheckDigit implements CheckDigitInterface
{
    use CheckDigitTrait;

    const TABLE = [
        [ 0, 3, 1, 7, 5, 9, 8, 6, 4, 2 ],
        [ 7, 0, 9, 2, 1, 5, 4, 8, 6, 3 ],
        [ 4, 2, 0, 6, 8, 7, 1, 3, 5, 9 ],
        [ 1, 7, 5, 0, 9, 8, 3, 4, 2, 6 ],
        [ 6, 1, 2, 3, 0, 4, 5, 9, 7, 8 ],
        [ 3, 6, 7, 4, 2, 0, 9, 5, 8, 1 ],
        [ 5, 8, 6, 9, 7, 2, 0, 1, 3, 4 ],
        [ 8, 9, 4, 5, 3, 6, 2, 0, 1, 7 ],
        [ 9, 4, 3, 8, 6, 1, 7, 2, 0, 5 ],
        [ 2, 5, 8, 1, 4, 3, 6, 7, 9, 0 ]
    ];

    /**
     * @inheritDoc
     */
    public function generate(string $sequence)
    {
        return $this->compute($this->toDigits($sequence));
    }

    /**
     * @inheritDoc
     */
    public function isValid(string $sequence)
    {
        $subSequence = substr($sequence, 0, -1);

        return strcmp($sequence, $this->compute($this->toDigits($subSequence))) === 0;
    }

    private function compute(array $sequence)
    {
        $lastDigit = 0;

        $row = 0;

        for ($i = 0; $i < count($sequence); $i++) {

            $lastDigit = self::TABLE[$row][$sequence[$i]];

            $row = $lastDigit;
        }

        return join(array_merge($sequence, [$lastDigit]));
    }
}
