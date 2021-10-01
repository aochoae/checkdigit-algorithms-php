# Check digit algorithms
[![Build Status](https://app.travis-ci.com/aochoae/checkdigit-algorithms-php.svg?branch=main)](https://app.travis-ci.com/aochoae/checkdigit-algorithms-php)

Algorithms:

* Damm algorithm
* Luhn algorithm
* Verhoeff algorithm

## Requirements

* PHP version 5.6 or greater

## Install

    composer require luisalberto/checkdigit-algorithms

## Usage

    <?php
    
    require_once(dirname( __FILE__ ) . '/vendor/autoload.php');

    $luhn = new \LuisAlberto\CheckDigit\LuhnCheckDigit();
    $luhn->isValid("48721484");

## License

Copyright 2021 Luis A. Ochoa

See [LICENSE](LICENSE) for the full license text.
