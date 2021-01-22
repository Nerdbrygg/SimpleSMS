<?php

namespace Nerdbrygg\SimpleSMS\Providers;

use Nerdbrygg\SimpleSMS\Exceptions\ProviderNotFound;

class ProviderRepository
{
    /**
     * Instanciate a new SMS Provider.
     *
     * @param  string $provider
     * @return Nerdbrygg\Contracts\SMSProviderInterface $class
     */
    public static function make($provider)
    {
        $class = 'Nerdbrygg\\SimpleSMS\\Providers\\'.str_replace(' ', '', $provider);

        if (! class_exists($class)) {
            throw new ProviderNotFound('Provider not found for '.$provider);
        }

        return new $class;
    }
}
