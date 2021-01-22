<?php

namespace Nerdbrygg\SimpleSMS\Support;

use Nerdbrygg\SimpleSMS\Exceptions\MissingParameter;

class NumberParser
{
    public static function parse($numbers)
    {
        if (is_null($numbers)) {
            throw new MissingParameter('Please provide a destination');
        }

        return (new static)->splitNumbers($numbers);
    }

    protected function splitNumbers($numbers)
    {
        $collection = collect(preg_split('/ ?[,;|.] ?/', $numbers));

        return $collection->map(function ($number) {
            return $this->prependCountryCode($number);
        });
    }

    protected function prependCountryCode($number, $countryCode = null)
    {
        if ((substr($number, 0, 2) === '47') && (strlen($number) === 10)) {
            return $number;
        }

        if (!is_null($countryCode)) {
            return $number = $countryCode . $number;
        }

        return config('simplesms.default.countryCode', 1) . $number;
    }
}
