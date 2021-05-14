<?php
/**
 * @copyright Copyright (c) Luis A. Ochoa
 * @since     1.0.0
 * @license   https://opensource.org/licenses/MIT MIT License
 */

namespace LuisAlberto\CheckDigit;

/**
 * Class VerhoeffCheckDigit
 *
 * @package LuisAlberto\CheckDigit
 * @since 1.0.0
 */
class VerhoeffCheckDigit implements CheckDigitInterface
{
    use CheckDigitTrait;

    const P = [
        [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ],
        [ 1, 5, 7, 6, 2, 8, 3, 0, 9, 4 ],
        [ 5, 8, 0, 3, 7, 9, 6, 1, 4, 2 ],
        [ 8, 9, 1, 6, 0, 4, 3, 5, 2, 7 ],
        [ 9, 4, 5, 3, 1, 2, 6, 8, 7, 0 ],
        [ 4, 2, 8, 6, 5, 7, 3, 9, 0, 1 ],
        [ 2, 7, 9, 3, 8, 0, 6, 4, 1, 5 ],
        [ 7, 0, 4, 6, 9, 1, 3, 2, 5, 8 ]
    ];

    const D = [
        [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ],
        [ 1, 2, 3, 4, 0, 6, 7, 8, 9, 5 ],
        [ 2, 3, 4, 0, 1, 7, 8, 9, 5, 6 ],
        [ 3, 4, 0, 1, 2, 8, 9, 5, 6, 7 ],
        [ 4, 0, 1, 2, 3, 9, 5, 6, 7, 8 ],
        [ 5, 9, 8, 7, 6, 0, 4, 3, 2, 1 ],
        [ 6, 5, 9, 8, 7, 1, 0, 4, 3, 2 ],
        [ 7, 6, 5, 9, 8, 2, 1, 0, 4, 3 ],
        [ 8, 7, 6, 5, 9, 3, 2, 1, 0, 4 ],
        [ 9, 8, 7, 6, 5, 4, 3, 2, 1, 0 ]
    ];

    const INV = [ 0, 4, 3, 2, 1, 5, 6, 7, 8, 9 ];

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
        $revert = array_reverse($this->toDigits($sequence));

        return ($this->getLastDigit($revert) === 0);

    }

    private function compute(array $sequence) {

        $newSequence = $sequence;

        array_push($newSequence, 0);

        $revert = array_reverse($newSequence);

        $lastDigit = self::INV[$this->getLastDigit($revert)];

        return join(array_merge($sequence, [$lastDigit]));
    }

    private function getLastDigit(array $sequence) {

        $c = 0;

        for ($i = 0; $i < count($sequence); $i++) {
            $c = self::D[$c][self::P[$i % 8][$sequence[$i]]];
        }

        return $c;
    }
}