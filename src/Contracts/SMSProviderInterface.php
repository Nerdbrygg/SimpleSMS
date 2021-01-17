<?php

namespace Nerdbrygg\SimpleSMS\Contracts;

use Nerdbrygg\SimpleSMS\SimpleSMS;

interface SMSProviderInterface
{
    public static function handle(SimpleSMS $sms);

    public function send($message);
}
